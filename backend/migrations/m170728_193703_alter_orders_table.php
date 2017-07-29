<?php

use yii\db\Migration;

class m170728_193703_alter_orders_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('orders', 'status', $this->integer()->null()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('orders', 'status');
    }
}
