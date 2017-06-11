<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m170526_220433_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer()->defaultValue(0),
            'sale_price' => $this->integer()->defaultValue(0),
            'quantity' => $this->integer()->defaultValue(0),
            'description' => $this->text(),
            'image' => $this->string()->null(),
        ]);


        // creates index for column `project_id`
        $this->createIndex(
            'idx-product-project_id',
            'products',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-product-project_id',
            'products',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-product-project_id',
            'products'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-product-project_id',
            'products'
        );

        $this->dropTable('products');
    }
}
