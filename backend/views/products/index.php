<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_id',
            'name',
            'price',
            'sale_price',
            // 'quantity',
            // 'description:ntext',
            // 'image',
            [
                'attribute' => 'image',
                'label' => Yii::t('app', 'Image'),
                'value' => function($model){
                    return !empty($model->image)? Yii::getAlias('@uploads') . '/' . $model->image : 'No Image' ;
                },
                'format' => ['image', ['width' => 100, 'height' => 100]],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
