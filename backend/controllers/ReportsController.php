<?php

namespace backend\controllers;

use app\models\Orders;

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

        $todayOrders = Orders::find()->where(['=','created_at',date('Y-m-d H:i:s')])->all();
        $todayOrdersCounter = count($todayOrders);

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

        ]);
    }

}
