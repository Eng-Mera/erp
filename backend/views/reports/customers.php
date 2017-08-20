<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-maroon">
                <div class="widget-user-image">
<!--                    <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">-->
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?= $topCustomer[0]['name']; ?></h3>
                <h5 class="widget-user-desc"><?= $topCustomer[0]['address1'] . ' , ' . $topCustomer[0]['city'] . ' , ' . $topCustomer[0]['gov'] ?></h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Total Orders <span class="pull-right badge bg-yellow"><?= $topCustomer[0]['totalOrders']; ?></span></a></li>
                    <li><a href="#">Total Amount <span class="pull-right badge bg-olive"><?= $topCustomer[0]['totalAmount']; ?></span></a></li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <div class="col-md-4">

    </div>
</div>
<div class="target-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'label' => 'Orders',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'customer_id' , $model->id])->count();
                    return '<span class="label label-info">'.$orders.'</span>';
                },
                'format' => 'html'

            ],
            [
                'label' => 'Total Amount',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'customer_id' , $model->id])->sum('total_amount');
                    return '<span class="label label-success">'. ( ($orders != 0 )? $orders : 0 ) .'</span>';
                },
                'format' => 'html'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{orders} {view}',
                'buttons' => [
                    'orders' => function ($url, $model) {
                        return Html::a('<span class="fa fa-shopping-basket"></span>', ['orders','id' => $model->id , 'type' => 'c'], ['class' => 'btn bg-maroon' , 'target' => '_blank']);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['customers/view','id' => $model->id], ['class' => 'btn bg-olive' , 'target' => '_blank']);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
