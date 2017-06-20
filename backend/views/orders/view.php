<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php echo Html::a('Invoice', ['invoice','id' => $model->id], ['class' => 'btn btn-warning']) ;?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user.username',
                'format' => 'text',
                'label' => 'User',
            ],
            [
                'attribute' => 'customer.name',
                'format' => 'text',
                'label' => 'Customer',
            ],
            [
                'attribute' => 'shipping_fees',
                'value' => (empty($model->shipping_fees))? 'Free' : $model->shipping_fees,
            ],
            'shipping_fees',
            'customer_notes',
            'product_notes',
        ],
    ]) ?>

</div>
