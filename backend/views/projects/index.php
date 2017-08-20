<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'attribute' => 'logo',
                'label' => Yii::t('app', 'Logo'),
                'value' => function($model){
                    return !empty($model->logo)? Yii::getAlias('@backendUrl') . '/uploads/' . $model->logo : 'No Image' ;
                },
                'format' => ['image', ['width' => 100, 'height' => 100]],
            ],
            'phone',
            [
                'attribute' => 'acc_num',
                'label' => 'Account Number',
            ],
            'city',
            'country',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{products}',
                'buttons' => [
                    'products' => function ($url, $model) {
                        return Html::a('<span class="fa fa-cubes"></span>', ['products','project_id' => $model->id], ['class' => 'btn bg-maroon' , 'target' => '_blank']);
                    },
                ]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
