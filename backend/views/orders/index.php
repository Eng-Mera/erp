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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',

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

            'shipping_fees',
            'customer_notes',
            // 'product_notes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
