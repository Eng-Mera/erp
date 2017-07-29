<?php

namespace backend\controllers;

use app\models\Customers;
use app\models\Orders;
use common\models\User;
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


        return $this->render('index', [
            'allOrdersCounter' => $allOrdersCounter,
            'totalAmount' => $totalAmount,
            'totalShippingFees' => $totalShippingFees,
            'todayOrdersCounter' => $todayOrdersCounter,
            'todayTotalAmount' => $todayTotalAmount,
            'todayShippingFees' => $todayShippingFees,
            'customers' => $customers,

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

        return $this->render('target',[
            'dataProvider' => $dataProvider
        ]);
    }

}
