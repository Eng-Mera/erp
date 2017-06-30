<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'acc_num')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php

        if (isset($model->logo) && !empty($model->logo))
        {
            echo Html::img( Yii::getAlias('@backendUrl') . '/uploads/' . $model->logo, [
                'width' => 100,
                'height' => 75
            ]);
        }
    ?>

    <?= $form->field($model, 'logo_mockup')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php

        if (isset($model->logo_mockup) && !empty($model->logo_mockup))
        {
            echo Html::img( Yii::getAlias('@backendUrl') . '/uploads/' . $model->logo_mockup, [
                'width' => 100,
                'height' => 75
            ]);
        }
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
