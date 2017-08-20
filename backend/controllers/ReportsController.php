<?php

namespace backend\controllers;

use app\models\Customers;
use app\models\Orders;
use app\models\Projects;
use backend\models\OrdersSearch;
use common\models\User;
use phpDocumentor\Reflection\Project;
use yii\data\ActiveDataProvider;

class ReportsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $totalAmount = 0;
        $totalShippingFees = 0;
        $todayTotalAmount = 0;
        $todayShippingFees = 0;

        $orders = Orders::find()->all();
        $allOrdersCounter = count($orders);

        $todayOrders = Orders::find()->where(['>=','created_at',date("Y-m-d",time())])->all();
        $todayOrdersCounter = Orders::find()->where(['>=','created_at',date("Y-m-d",time())])->count();

        $customers = Customers::find()->count();

        $totalProjects = Projects::find()->count();

        foreach ($orders as $order)
        {
            $totalAmount += $order->total_amount;
            $totalShippingFees += $order->shipping_fees;
        }

        foreach ($todayOrders as $todayOrder)
        {
            $todayTotalAmount += $todayOrder->total_amount;
            $todayShippingFees += $todayOrder->shipping_fees;
        }


        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand("SELECT  a.`id`,
                a.`name`,
                COUNT(b.`customer_id`) totalOrders,
                SUM(b.`total_amount`) totalAmount
        FROM    `customers` a
                LEFT JOIN `orders` b
                    ON a.`id` = b.`customer_id`
        GROUP   BY a.`id`,
                a.`name`
        ORDER BY COUNT(*) DESC
        LIMIT 1");

        $topCustomer = $command->queryAll();

        $projectCommand = $connection->createCommand("SELECT a.`project_id` FROM `products` a 
                LEFT JOIN `orders_products` b ON a.`id` = b.`product_id` 
                GROUP BY a.`project_id` ORDER BY COUNT(*) DESC LIMIT 1
            ");

        $topProjectId = $projectCommand->queryAll();

        $topProject = Projects::find()->where(['=','id',$topProjectId[0]['project_id']])->one();

        $projectTotalAmountCommand = $connection->createCommand("SELECT COUNT(*) AS Orders , SUM(`total_amount`) AS TotalAmount 
              FROM `orders` WHERE `id` IN ( 
                SELECT `order_id` FROM `orders_products` WHERE `product_id` IN (
                  SELECT `id` FROM `products` WHERE `project_id` = ".$topProject->id.") 
                  GROUP BY `order_id`)
            ");

        $projectTotalAmount = $projectTotalAmountCommand->queryAll();

        return $this->render('index', [
            'allOrdersCounter' => $allOrdersCounter,
            'totalAmount' => $totalAmount,
            'totalShippingFees' => $totalShippingFees,
            'todayOrdersCounter' => $todayOrdersCounter,
            'todayTotalAmount' => $todayTotalAmount,
            'todayShippingFees' => $todayShippingFees,
            'customers' => $customers,
            'topCustomer' => $topCustomer,
            'topProject' => $topProject,
            'totalProjects' => $totalProjects,
            'projectTotalAmount' => $projectTotalAmount,
        ]);
    }

    public function getRoleUsers($role)
    {
        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand("SELECT * FROM `rbac_auth_assignment` INNER JOIN `user` ON `rbac_auth_assignment`.`user_id` = `user`.`id`".
            " WHERE `rbac_auth_assignment`.`item_name` = '" . $role . "';");
        $users = $command->queryAll();
        $connection->close();

        return $users;
    }

    public function actionTarget()
    {
//        $query = $this->getRoleUsers('callcenter');

//        $sql = "SELECT * FROM `rbac_auth_assignment` INNER JOIN `user` ON `rbac_auth_assignment`.`user_id` = `user`.`id` WHERE `rbac_auth_assignment`.`item_name` = 'callcenter'";

//        $users = User::findBySql($sql);
        $users = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $users,
        ]);

        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand("SELECT  a.`id`,
                a.`username`,
                a.`project_id`,
                COUNT(b.`user_id`) totalOrders,
                SUM(b.`total_amount`) totalAmount
        FROM    `user` a
                LEFT JOIN `orders` b
                    ON a.`id` = b.`user_id`
        GROUP   BY a.`id`,
                a.`username`
        ORDER BY COUNT(*) DESC
        LIMIT 1");

        $topUser = $command->queryAll();

        $user = User::find()->where(['=' , 'id' , $topUser[0]['id']])->with('userProfile')->one();
        $avatar = $user->userProfile->getAvatar();

        $project = Projects::find()->select('name')->where(['=','id',$topUser[0]['project_id']])->scalar();

        return $this->render('target',[
            'dataProvider' => $dataProvider,
            'topUser' => $topUser,
            'avatar' => $avatar,
            'project' => $project,
        ]);
    }

    public function actionOrders($id,$type)
    {
        if ($type == 'u' or $type == 'c')
        {
            if (!empty($id))
            {
                $data = [];
                $searchModel = new OrdersSearch();
                if ($type == 'u')
                {
                    $data = ['OrdersSearch' => ['user_id' => $id]];
                }
                elseif ($type == 'c')
                {
                    $data = ['OrdersSearch' => ['customer_id' => $id]];
                }
                $dataProvider = $searchModel->search($data);

                return $this->render('orders', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        return $this->redirect('index');
    }

    public function actionCustomers()
    {
        $customers = Customers::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $customers,
        ]);

        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand("SELECT  a.`id`,
                a.`name`,
                a.`address1`,
                a.`city`,
                a.`gov`,
                COUNT(b.`customer_id`) totalOrders,
                SUM(b.`total_amount`) totalAmount
        FROM    `customers` a
                LEFT JOIN `orders` b
                    ON a.`id` = b.`customer_id`
        GROUP   BY a.`id`,
                a.`name`
        ORDER BY COUNT(*) DESC
        LIMIT 1");

        $topCustomer = $command->queryAll();

        return $this->render('customers',[
            'dataProvider' => $dataProvider,
            'topCustomer' => $topCustomer,
        ]);
    }

}
