<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 */
class m170526_213706_create_projects_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'logo' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('projects');
    }
}
