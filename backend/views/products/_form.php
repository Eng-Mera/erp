<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Projects;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">

        <?php echo Html::activeDropDownList($model, 'project_id', ArrayHelper::map(Projects::find()->all(), 'id', 'name') , ['prompt' => 'Select Project' , 'class' => 'form-control']);  ?>

    </div>
    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'price')->textInput(['type' => 'number' , 'min' => 0]) ?>

    <?php echo $form->field($model, 'sale_price')->textInput(['type' => 'number' , 'min' => 0]) ?>

    <?php echo $form->field($model, 'quantity')->textInput(['type' => 'number' , 'min' => 0]) ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php
    if (isset($model->image) && !empty($model->image))
        echo Html::img(Yii::getAlias('@uploads') . '/' . $model->image, [
            'width' => 100,
            'height' => 75
        ]);
    ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
