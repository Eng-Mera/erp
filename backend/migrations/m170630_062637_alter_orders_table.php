<?php

use yii\db\Migration;

class m170630_062637_alter_orders_table extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'created_at', $this->dateTime()->null());
        $this->addColumn('orders', 'updated_at', $this->dateTime()->null());
    }

    public function down()
    {
        $this->dropColumn('orders', 'created_at');
        $this->dropColumn('orders', 'updated_at');
    }
}
