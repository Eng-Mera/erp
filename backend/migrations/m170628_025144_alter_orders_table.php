<?php

use yii\db\Migration;

class m170628_025144_alter_orders_table extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'print_count', $this->integer()->null()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('orders', 'print_count');
    }
}
