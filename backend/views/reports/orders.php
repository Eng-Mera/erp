<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Target';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                        return Html::a('<span class="fa fa-print"></span>', ['orders/print','id' => $model->id], ['class' => 'btn btn-warning' , 'target' => '_blank']);
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['orders/view', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['orders/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                        ]);
                    },

                    'delete' =>
                        function ($url, $model) {
                            $url = \yii\helpers\Url::to(['orders/delete', 'id' => $model->id]);
                            return Html::a('<span class="fa fa-trash"></span>', $url, [
                                'title'        => 'delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method'  => 'post',
                            ]);
                        },
                ],
            ],
        ],
    ]); ?>


</div>
