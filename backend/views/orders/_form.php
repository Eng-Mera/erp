<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use app\models\Customers;
use yii\helpers\ArrayHelper;
use app\models\Products;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <label for="customer_id">Customer</label>
        <?php

            $customers = Customers::find()
                ->select(['phone1 as value'  , 'id as id' , 'name'])
                ->asArray()
                ->all();

            echo AutoComplete::widget([
                'model' => $model,
                'attribute' => 'customer_id',
                'clientOptions' => [
                    'source' => $customers,
                ],
                'options' =>[
                    'class' => 'form-control',
                ]
            ]);
        ?>
    </div>

    <div class="form-group">

        <?php echo Html::activeDropDownList($model, 'product', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control']);  ?>

    </div>

    <?php echo $form->field($model, 'shipping_fees')->textInput(['type' => 'number' , 'step' => '0.1' , 'min' => '0']) ?>

    <?php echo $form->field($model, 'customer_notes')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'product_notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
