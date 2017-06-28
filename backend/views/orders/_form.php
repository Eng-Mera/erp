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

    <?php
        if (!($model->isNewRecord))
        {
                foreach ($products as $product)
                {
    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quantity">Quantity</label>
                                <?php echo $form->field($model,'products[][quantity]')->textInput(['type' => 'number' , 'min' => '0' , 'class'=>'form-control','value' => $product['quantity']])->label(false) ?>
                            </div>
                            <div class="col-md-8">
                                <label for="product"> Products </label>
                                <?php echo Html::activeDropDownList($model, 'products[][product]', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control', 'value' => $product['product']->id]);  ?>
                            </div>
                        </div>
                    </div>
    <?php
                }
                if (count($products) <= 3)
                {
                    for ( $i = 0 ; $i < (3 - count($products)) ; $i++)
                    {
    ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="quantity">Quantity</label>
                                    <?php echo $form->field($model,'products[][quantity]')->textInput(['type' => 'number' , 'min' => '0' , 'class'=>'form-control'])->label(false) ?>
                                </div>
                                <div class="col-md-8">
                                    <label for="product"> Products </label>
                                    <?php echo Html::activeDropDownList($model, 'products[][product]', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control']);  ?>
                                </div>
                            </div>
                        </div>
    <?php
                    }
                }
        }
        else
        {
    ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="quantity">Quantity</label>
                        <?php echo $form->field($model,'products[][quantity]')->textInput(['type' => 'number' , 'min' => '0' , 'class'=>'form-control'])->label(false) ?>
                    </div>
                    <div class="col-md-8">
                        <label for="product"> Products </label>
                        <?php echo Html::activeDropDownList($model, 'products[][product]', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control']);  ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="quantity">Quantity</label>
                        <?php echo $form->field($model,'products[][quantity]')->textInput(['type' => 'number' , 'min' => '0' , 'class'=>'form-control'])->label(false) ?>
                    </div>
                    <div class="col-md-8">
                        <label for="product"> Products </label>
                        <?php echo Html::activeDropDownList($model, 'products[][product]', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control']);  ?>
                    </div>
                </div>
            </div>
    <?php
        }

    ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="quantity">Quantity</label>
                <?php echo $form->field($model,'products[][quantity]')->textInput(['type' => 'number' , 'min' => '0' , 'class'=>'form-control'])->label(false) ?>
            </div>
            <div class="col-md-8">
                <label for="product"> Products </label>
                <?php echo Html::activeDropDownList($model, 'products[][product]', ArrayHelper::map(Products::find()->all(), 'id', 'name') , ['prompt' => 'Select Product' , 'class' => 'form-control']);  ?>
            </div>
        </div>
    </div>

    <?php echo $form->field($model, 'shipping_fees')->textInput(['type' => 'number' , 'step' => '0.1' , 'min' => '0']) ?>

    <?php echo $form->field($model, 'customer_notes')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'product_notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
