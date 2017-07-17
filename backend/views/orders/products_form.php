<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Products;
?>

<style type="text/css">
    ul {
        list-style-type: none;
    }

    /*li {*/
        /*display: inline-block;*/
    /*}*/

    input[type="checkbox"][id^="prod"] {
        display: none;
    }

    label {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
    }

    label:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    label img {
        height: 100px;
        width: 100px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
    }

    :checked + label {
        border-color: #ddd;
    }

    :checked + label:before {
        content: "✓";
        background-color: grey;
        transform: scale(1);
    }

    :checked + label img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: -1;
    }
</style>

<ul>
    <?php
        foreach ($allProducts as $product)
        {
    ?>
            <li style="display: inline-block;">
                <input type="checkbox" name="products[][product]" id="<?= "prod". $product->id ?>" />
                <label for="<?= "prod". $product->id ?>">
                    <img src="<?= Yii::getAlias('@backendUrl') . '/uploads/' .  $product->image; ?>" alt="<?= $product->name; ?>">
                </label>
                <div class="col-md-5">
                    <input type="number" name="products[][quantity]" min="0" class="form-control">
                </div>
                    <?= $product->name; ?>
            </li>
    <?php
        }
    ?>
</ul>
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