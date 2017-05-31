<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders_products`.
 */
class m170531_231445_create_orders_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('orders_products', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-orders-products-order_id',
            'orders_products',
            'order_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-orders-products-order_id',
            'orders_products',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );


        // creates index for column `project_id`
        $this->createIndex(
            'idx-orders-products-product_id',
            'orders_products',
            'product_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-orders-products-product_id',
            'orders_products',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-orders-products-product_id',
            'orders_products'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-orders-products-product_id',
            'orders_products'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-orders-products-order_id',
            'orders_products'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-orders-products-order_id',
            'orders_products'
        );

        $this->dropTable('orders_products');
    }
}
