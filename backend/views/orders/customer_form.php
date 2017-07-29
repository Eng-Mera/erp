
<?php

use yii\jui\AutoComplete;
use app\models\Customers;
?>


<div class="form-group">
    <label for="customer_id">Search for Customer</label>
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
            'onChange' => 'getCustomer(this.value)',
        ]
    ]);

    ?>
</div>

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Information</h3>
            </div>
                <div class="box-body">
                    <div class="form-group">
                        <?php echo $form->field($customer, 'name')->textInput(['maxlength' => true , 'class' => 'form-control']) ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->field($customer, 'email')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->field($customer, 'facebook')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                    </div>

                    <div class="form-group col-xs-6">
                        <?php echo $form->field($customer, 'phone1')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                    </div>
                    <div class="form-group col-xs-6">
                        <?php echo $form->field($customer, 'phone2')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                    </div>
                </div>
                <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3>Customer Address</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo $form->field($customer, 'address1')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->field($customer, 'address2')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->field($customer, 'city')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?php echo $form->field($customer, 'gov')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pull-right">
    <a class="btn btn-warning btnNext" >Next</a>
</div>
