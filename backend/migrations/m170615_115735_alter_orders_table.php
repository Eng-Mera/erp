<?php

use yii\db\Migration;

class m170615_115735_alter_orders_table extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'total_amount', $this->float()->null()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('orders', 'total_amount');
    }
}
