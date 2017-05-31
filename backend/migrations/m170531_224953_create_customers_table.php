<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customers`.
 */
class m170531_224953_create_customers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('customers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone1' => $this->string()->notNull(),
            'phone2' => $this->string()->null(),
            'email' => $this->string()->notNull(),
            'facebook' => $this->string()->null(),
            'address1' => $this->string()->notNull(),
            'address2' => $this->string()->null(),
            'city' => $this->string()->notNull(),
            'gov' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('customers');
    }
}
