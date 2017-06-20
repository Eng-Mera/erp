<?php

namespace backend\controllers;

use app\models\Customers;
use app\models\OrdersProducts;
use app\models\Products;
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

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        if ($model->load(Yii::$app->request->post()))
        {
            $totalAmount = 0;
            $customerId = Customers::find()->select('id')->where(['or', ['=' , 'phone1' , $model->customer_id],['=' , 'phone2' , $model->customer_id]])->scalar();
            if (!empty($customerId))
            {
                $model->customer_id = $customerId;
            }
            $model->user_id = Yii::$app->user->id;

            if ($model->save())
            {
                $products = Yii::$app->request->post()['Orders']['products'];
                $chunks = array_chunk ( $products , 2 );

                foreach ($chunks as $chunk)
                {
                    $quantity = $chunk[0]['quantity'];
                    $product = $chunk[1]['product'];
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

                $model->total_amount = $totalAmount + $model->shipping_fees;

                $model->update();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionInvoice($id)
    {
        $model = $this->findModel($id);
        $products = [];

        foreach ($model->ordersProducts as $product)
        {
            $productModel = Products::find()->where(['=' , 'id' , $product->product_id])->one();
            $products[] = ["name" => $productModel->name , 'quantity' => $product->counter , 'price' => $productModel->sale_price];
        }

        $customer = Customers::find()->where(['=','id',$model->customer_id])->one();
        return $this->render('invoice',[
            'model' => $model,
            'customer' => $customer,
            'products' => $products,
        ]);
    }

    public function actionPrint($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        $products = [];

        foreach ($model->ordersProducts as $product)
        {
            $productModel = Products::find()->where(['=' , 'id' , $product->product_id])->one();
            $products[] = ["name" => $productModel->name , 'quantity' => $product->counter , 'price' => $productModel->sale_price];
        }

        $customer = Customers::find()->where(['=','id',$model->customer_id])->one();
        return $this->render('print',[
            'model' => $model,
            'customer' => $customer,
            'products' => $products,
        ]);
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
