<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects_users`.
 */
class m170530_023024_create_projects_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('projects_users', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);


        // creates index for column `project_id`
        $this->createIndex(
            'idx-projects-project_id',
            'projects_users',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-project-project_id',
            'projects_users',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );


        // creates index for column `project_id`
        $this->createIndex(
            'idx-users-user_id',
            'projects_users',
            'user_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-users-user_id',
            'projects_users',
            'user_id',
            'user',
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
            'fk-project-project_id',
            'projects_users'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-projects-project_id',
            'projects_users'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-users-user_id',
            'projects_users'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-users-user_id',
            'projects_users'
        );

        $this->dropTable('projects_users');
    }
}
