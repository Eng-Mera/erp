<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'project.name',
                'format' => 'text',
                'label' => 'Project',
            ],
            'name',
            'price',
            'sale_price',
            'quantity',
            'description:ntext',
            [
                'attribute' => 'image',
                'label' => Yii::t('app', 'Image'),
                'value' => Yii::getAlias('@backendUrl') . '/uploads/' . $model->image,
                'format' => ['image', ['width' => 100, 'height' => 100]]
            ],
        ],
    ]) ?>

</div>
