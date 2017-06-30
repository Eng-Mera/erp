<?php

namespace backend\controllers;

use app\models\Orders;

class ReportsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $orders = Orders::find()->all();
        $allOrdersCounter = count($orders);
        $totalAmount = 0;
        $totalShippingFees = 0;
//        $todayOrders = Orders::find()->where()
        foreach ($orders as $order)
        {
            $totalAmount += $order->total_amount;
            $totalShippingFees += $order->shipping_fees;
        }

        return $this->render('index', [
            'allOrdersCounter' => $allOrdersCounter,
            'totalAmount' => $totalAmount,
            'totalShippingFees' => $totalShippingFees,

        ]);
    }

}
