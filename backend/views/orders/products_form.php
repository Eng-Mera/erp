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
            <li style="display: inline-block; margin-top: 10px">
                <p style="text-align: center"><?= $product->name; ?></p>
                <input type="checkbox" name="Products[][product]" id="<?= "prod". $product->id ?>" value="<?= $product->id ?>"/>
                <label style="text-align: center" for="<?= "prod". $product->id ?>">
                    <img src="<?= Yii::getAlias('@backendUrl') . '/uploads/' .  $product->image; ?>" alt="<?= $product->name; ?>">
                </label>

                <div>
                    <input type="number" name="Products[][quantity]" min="0" class="form-control" placeholder="quantity">
                </div>
            </li>
    <?php
        }
    ?>
</ul>

<div class="pull-right">
    <a class="btn btn-info btnPrevious" >Previous</a>
    <a class="btn btn-warning btnNext" >Next</a>
</div>