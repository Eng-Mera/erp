<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

?>
<div class="target-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            [
                'label' => 'Orders',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'user_id' , $model->id])->count();
                    return $orders;
                }
            ],
            [
                'label' => 'Total Amount',
                'value' => function($model) {
                    $orders = \app\models\Orders::find()->where(['=' , 'user_id' , $model->id])->sum('total_amount');
                    return ($orders != 0 )? $orders : 0;
                }
            ],
        ],
    ]); ?>


</div>
