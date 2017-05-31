<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m170531_225815_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'shipping_fees' => $this->float()->defaultValue(0),
            'customer_notes' => $this->string()->null(),
            'product_notes' => $this->string()->null(),

        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-orders-user_id',
            'orders',
            'user_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-orders-user_id',
            'orders',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );


        // creates index for column `project_id`
        $this->createIndex(
            'idx-customers-customer_id',
            'orders',
            'customer_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-customers-customer_id',
            'orders',
            'customer_id',
            'customers',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-customers-customer_id',
            'orders'
        );

        $this->dropIndex(
            'idx-customers-customer_id',
            'orders'
        );
//
        $this->dropForeignKey(
            'fk-orders-user_id',
            'orders'
        );

        $this->dropIndex(
            'idx-orders-user_id',
            'orders'
        );
        $this->dropTable('orders');
    }
}
