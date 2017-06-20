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

    <?= $form->field($model, 'logo')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php

//    echo Yii::$app->request->baseUrl."<br/>" ;
//    print_r(Yii::$app->request->baseUrl);
//    echo "<br/>";
    var_dump(Yii::$app->urlManagerBackend);
    echo "<br/>";
//    echo Yii::$app->request->getBaseUrl(true);

//    var_dump(Url::base());
    die();
//    var_dump(Yii::$app->getUrlManager()->baseUrl);die();
//    var_dump(Yii::$app->request->baseUrl);die();

    if (isset($model->logo) && !empty($model->logo))
//        echo Html::img(Yii::getAlias('@webroot') . '/uploads/' . $model->logo, [
        echo Html::img( 'http://backend.erp.com/uploads/' . $model->logo, [
            'width' => 100,
            'height' => 75
        ]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
