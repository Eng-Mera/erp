<?php
use yii\helpers\Html;
?>

<div class="form-group">
    <label for="orders-status">Order's Status</label>
    <?php echo
    Html::activeDropDownList($model, 'status',
        [
            '0' => 'Pending' ,
            '1' => 'Processing' ,
            '2' => 'Shipped' ,
            '3' => 'Delivered'
        ] ,
        ['prompt' => 'Order\'s Status' , 'class' => 'form-control']);
    ?>
</div>

<?php echo $form->field($model, 'shipping_fees')->textInput(['type' => 'number' , 'value' => '20' , 'disabled' => 'disabled' , 'step' => '0.1' , 'min' => '0']) ?>

<?php echo $form->field($model, 'customer_notes')->textarea(['rows' => 6]) ?>



<div class="pull-right">
    <a class="btn btn-info btnPrevious" >Previous</a>
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
