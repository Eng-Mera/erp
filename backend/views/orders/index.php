<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'user_id ',
                'label' => 'User',
                'value' => function($model) {
                    return \common\models\User::find()->where('id='.$model['user_id'])->one()->username;
                }
            ],

            [
                'attribute' => 'customer_id ',
                'label' => 'Customer ',
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
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{print}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="fa fa-print"></span>', ['print','id' => $model->id], ['class' => 'btn btn-warning' , 'target' => '_blank']);
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

</div>
