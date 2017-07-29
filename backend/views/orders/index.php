<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number"><?= $allOrders; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Today's Order</span>
                <span class="info-box-number"><?= $todayOrders; ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number"><?= $customers ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($model){
            if($model->print_count == 1)
            {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function($model) {
                    return \common\models\User::find()->where('id='.$model['user_id'])->one()->username;
                }
            ],

            [
                'attribute' => 'customer_id',
                'label' => 'Customer',
                'value' => function($model) {
                    return \app\models\Customers::find()->where('id='.$model['customer_id'])->one()->name;
                }
            ],

            'total_amount',

            [
                'attribute' => 'shipping_fees',
                'value' => function($model) {
                    return (empty($model->shipping_fees))? 'Free' : $model->shipping_fees;
                }
            ],
            [
                'attribute' => 'customer.gov',
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->status == 0 ) { return '<span class="label label-info">Pending</span>'; }
                    if ($model->status == 1 ) { return '<span class="label label-danger">Processing</span>'; }
                    if ($model->status == 2 ) { return '<span class="label label-warning">Shipped</span>'; }
                    if ($model->status == 3 ) { return '<span class="label label-success">Delivered</span>'; }

                }
            ],
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{print}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="fa fa-print"></span>', ['print','id' => $model->id], ['class' => 'btn bg-purple' , 'target' => '_blank']);
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

</div>
