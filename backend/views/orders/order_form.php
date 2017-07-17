<?php
use yii\helpers\Html;
?>
<?php echo $form->field($model, 'shipping_fees')->textInput(['type' => 'number' , 'step' => '0.1' , 'min' => '0']) ?>

<?php echo $form->field($model, 'customer_notes')->textarea(['rows' => 6]) ?>

<?php echo $form->field($model, 'product_notes')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
