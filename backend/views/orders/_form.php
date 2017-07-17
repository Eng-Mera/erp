<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="orders-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>


    <?=
        Tabs::widget([
            'items' => [
                [
                    'label' => 'Customer',
                    'content' => $this->render('customer_form', ['customer' => $customer, 'model' => $model , 'form' => $form]),
                    'active' => true
                ],
                [
                    'label' => 'Products',
                    'content' => $this->render('products_form', ['model' => $model , 'allProducts' => $allProducts, 'form' => $form]),
                ],
                [
                    'label' => 'Order',
                    'content' => $this->render('order_form', ['model' => $model, 'form' => $form]),
                ],
            ]]);
    ?>

    <?php ActiveForm::end(); ?>


</div>
