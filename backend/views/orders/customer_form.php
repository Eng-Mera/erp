
<?php

use yii\jui\AutoComplete;
use app\models\Customers;
?>

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

<?php echo $form->field($customer, 'name')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'phone1')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'phone2')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'email')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'facebook')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'address1')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'address2')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'city')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($customer, 'gov')->textInput(['maxlength' => true]) ?>