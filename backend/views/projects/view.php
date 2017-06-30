<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

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
            'name',
            'phone',
            [
                'attribute' => 'acc_num',
                'label' => 'Account Number',
            ],
            'city',
            'country',
            [
                'attribute' => 'logo',
                'label' => Yii::t('app', 'Image'),
                'value' => Yii::getAlias('@backendUrl') . '/uploads/' . $model->logo,
                'format' => ['image', ['width' => 100, 'height' => 100]]
            ],
            [
                'attribute' => 'logo_mockup',
                'label' => Yii::t('app', 'Mockup'),
                'value' => Yii::getAlias('@backendUrl') . '/uploads/' . $model->logo_mockup,
                'format' => ['image', ['width' => 100, 'height' => 100]]
            ],
        ],
    ]) ?>

</div>
