<?php

namespace backend\controllers;

use app\models\Customers;
use app\models\OrdersProducts;
use app\models\Products;
use app\models\Projects;
use common\models\User;
use Yii;
use app\models\Orders;
use backend\models\OrdersSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            
        ];
    }

    public function actionGetcustomer($num)
    {
        $customer = Customers::find()->where(['or',['=','phone1',$num],['=','phone2',$num]])->one()->toArray();
        return json_encode($customer);
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $allOrders = Orders::find()->count();
        $todayOrders = Orders::find()->andWhere(['>=', 'created_at', date("Y-m-d",time())])->count();
        $customers = Customers::find()->count();

        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allOrders' => $allOrders,
            'todayOrders' => $todayOrders,
            'customers' => $customers,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $customer = new Customers();
        $allProducts = Products::find()->all();
        $totalAmount = 0;
        if ($model->load(Yii::$app->request->post()))
        {
            $postData = Yii::$app->request->post();
            if (array_key_exists("Customers",Yii::$app->request->post()))
            {
                $customerInfo = $postData['Customers'];
                $customerModel = new Customers();
                $customerModel->name = $customerInfo['name'];
                $customerModel->email = $customerInfo['email'];
                $customerModel->facebook = $customerInfo['facebook'];
                $customerModel->phone1 = $customerInfo['phone1'];
                $customerModel->phone2 = $customerInfo['phone2'];
                $customerModel->address1 = $customerInfo['address1'];
                $customerModel->address2 = $customerInfo['address2'];
                $customerModel->city = $customerInfo['city'];
                $customerModel->gov = $customerInfo['gov'];
                $customerModel->save();
                $model->customer_id = $customerModel->id;
            }
            else
            {
                $customerId = Customers::find()->select('id')->where(['or' , ['=' , 'phone1' , $postData['Orders']['customer_id']] , ['=' , 'phone2' , $postData['Orders']['customer_id']]])->scalar();
                if (!empty($customerId))
                {
                    $model->customer_id = $customerId;
                }
                else
                {
                    throw new NotFoundHttpException();

                }
            }

            $model->user_id = Yii::$app->user->id;
            $model->customer_notes = $postData['Orders']['customer_notes'];
            $model->status = $postData['Orders']['status'];
            $model->shipping_fees = 20;
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");

            if ($model->save())
            {
                $products = $postData['Products'];
                $chunks = array_chunk ( $products , 2 );
                $chunks = array_filter($chunks);
                foreach ($chunks as $chunk)
                {
                    if (array_key_exists('product',$chunk[0]) and !empty($chunk[0]['product']) and array_key_exists('quantity',$chunk[1]) and !empty($chunk[1]['quantity']))
                    {
                        $product = $chunk[0]['product'];
                        $quantity = $chunk[1]['quantity'];
                        if (!empty($quantity) and !empty($product))
                        {
                            $productModel = new OrdersProducts();
                            $productModel->order_id = $model->id;
                            $productModel->product_id = $product;
                            $productModel->counter = $quantity;
                            $productModel->save();

                            $productPrice = Products::find()->select('sale_price')->where( ['=' , 'id' , $product])->scalar();
                            $totalAmount += ($productPrice * $quantity);
                        }
                    }
                }

                $model->total_amount = $totalAmount;

                $model->update();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'customer' => $customer,
            'allProducts' => $allProducts,
        ]);

    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date("Y-m-d H:i:s");

        $customer = Customers::find()->where(['=','id',$model->customer_id])->one();
        $allProducts = Products::find()->all();

        $productsIds = OrdersProducts::find()->select(['product_id','counter'])->where(['=' , 'order_id', $id])->all();
        $products = [];
        $ids = [];
        foreach ($productsIds as $productId)
        {
            $ids[] = $productId->product_id;
            $products[] = [ 'product' => Products::find()->where(['=' , 'id' , $productId->product_id])->one(), 'quantity' => $productId->counter ];
        }

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save()) {
                $ordersProducts = Yii::$app->request->post()['Orders']['products'];
                $chunks = array_chunk($ordersProducts, 2);

                $chunksProductIds = [];
                foreach ($chunks as $chunk)
                {
                    $quantity = (int)$chunk[0]['quantity'];
                    $product = (int)$chunk[1]['product'];
                    $chunksProductIds[] = $product;
                    if (!empty($quantity) and !empty($product))
                    {
                        foreach ($productsIds as $productsId)
                        {
                            if (in_array($product , $ids))
                            {
                                if ($product == $productsId->product_id)
                                {
                                    if ($quantity != $productsId->counter)
                                    {
                                        $prod = OrdersProducts::find()->where(['and' , ['=' , 'order_id' , $id] , ['=' , 'product_id' , $productsId->product_id]])->one();
                                        $prod->counter = $quantity;
                                        $prod->update();
                                    }
                                }
                            }
                            else
                            {
                                $productModel = new OrdersProducts();
                                $productModel->order_id = $model->id;
                                $productModel->product_id = $product;
                                $productModel->counter = $quantity;
                                $productModel->save();
                                $ids[] = $productModel->product_id;
                            }
                        }
                    }
                }
                $chunksProductIds = array_filter($chunksProductIds);
                foreach ($ids as $prodId)
                {
                    if (!in_array($prodId , $chunksProductIds))
                    {
                        $prodModel = OrdersProducts::find()->where(['and', ['=','order_id', $id] , ['=','product_id' , $prodId]])->one();
                        $prodModel->delete();
                    }
                }


                $totalAmount = 0;
                $orderProducts = OrdersProducts::find()->where(['=' , 'order_id' , $model->id ])->all();
                foreach ($orderProducts as $orderProduct)
                {
                    $productPrice = Products::find()->select('sale_price')->where(['=', 'id', $orderProduct->product_id])->scalar();
                    $totalAmount += ($productPrice * $orderProduct->counter);
                }
                $model->total_amount = $totalAmount;

                $model->update();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                    'products' => $products,
                    'customer' => $customer,
                    'allProducts' => $allProducts
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'products' => $products,
                'customer' => $customer,
                'allProducts' => $allProducts
            ]);
        }
    }

    public function actionInvoice($id)
    {
        $model = $this->findModel($id);
        $products = [];
        $projectId = 0;
        $project = [];

        foreach ($model->ordersProducts as $product)
        {
            $productModel = Products::find()->where(['=' , 'id' , $product->product_id])->one();
            $projectId = $productModel->project_id;
            $products[] = ["name" => $productModel->name , 'quantity' => $product->counter , 'price' => $productModel->sale_price];
        }
        if ($projectId != 0)
        {
            $project = Projects::find()->where(['=' , 'id' , $projectId])->one();
        }

        $customer = Customers::find()->where(['=','id',$model->customer_id])->one();
        return $this->render('invoice',[
            'model' => $model,
            'customer' => $customer,
            'products' => $products,
            'project' => $project,
        ]);
    }

    public function actionPrint($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        $model->print_count = 1;
        $model->update();
        $products = [];
        $projectId = 0;
        $project = [];

        foreach ($model->ordersProducts as $product)
        {
            $productModel = Products::find()->where(['=' , 'id' , $product->product_id])->one();
            $projectId = $productModel->project_id;
            $products[] = ["name" => $productModel->name , 'quantity' => $product->counter , 'price' => $productModel->sale_price];
        }

        if ($projectId != 0)
        {
            $project = Projects::find()->where(['=' , 'id' , $projectId])->one();
        }

        $customer = Customers::find()->where(['=','id',$model->customer_id])->one();
        return $this->render('print',[
            'model' => $model,
            'customer' => $customer,
            'products' => $products,
            'project' => $project,
        ]);
    }

    public function actionCorrecting()
    {
        $orders = Orders::find()->all();
        foreach ($orders as $order)
        {
            $totalAmount = 0;
            $orderProducts = OrdersProducts::find()->where(['=' , 'order_id' , $order->id ])->all();
            foreach ($orderProducts as $orderProduct)
            {
                $productPrice = Products::find()->select('sale_price')->where(['=', 'id', $orderProduct->product_id])->scalar();
                $totalAmount += ($productPrice * $orderProduct->counter);
            }
            $order->total_amount = $totalAmount;

            $order->update();
        }
        return true;
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
