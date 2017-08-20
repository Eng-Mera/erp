<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Targets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username"><?= $topUser[0]['username'] ?></h3>
                <h5 class="widget-user-desc">Top User</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="<?= $avatar ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= $project ?></h5>
                            <span class="description-text">Project</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= $topUser[0]['totalAmount'] ?></h5>
                            <span class="description-text">Total Amount</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header"><?= $topUser[0]['totalOrders'] ?></h5>
                            <span class="description-text">Total Orders</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<div class="target-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            [
                'label' => 'Orders',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'user_id' , $model->id])->count();
                    return '<span class="label label-danger">'.$orders.'</span>';
                },
                'format' => 'html'
            ],
            [
                'label' => 'Total Amount',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'user_id' , $model->id])->sum('total_amount');
                    return '<span class="label label-warning">'. ( ($orders != 0 )? $orders : 0 ) .'</span>';
                },
                'format' => 'html'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{orders} {view}',
                'buttons' => [
                    'orders' => function ($url, $model) {
                        return Html::a('<span class="fa fa-shopping-basket"></span>', ['orders','id' => $model->id , 'type' => 'u'], ['class' => 'btn bg-blue' , 'target' => '_blank']);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['user/view','id' => $model->id], ['class' => 'btn bg-navy' , 'target' => '_blank']);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
