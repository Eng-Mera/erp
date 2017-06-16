<?php

use yii\db\Migration;

class m170610_220339_alter_orders_products_table extends Migration
{
    public function up()
    {
        $this->addColumn('orders_products', 'counter', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('orders_products', 'counter');
    }
}
