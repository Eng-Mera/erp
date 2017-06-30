<?php

use yii\db\Migration;

class m170630_035332_alter_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'project_id', $this->integer()->null());

        // creates index for column `project_id`
        $this->createIndex(
            'idx-user-project_id',
            'user',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-user-project_id',
            'user',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );


    }

    public function down()
    {

        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-user-project_id',
            'user'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-user-project_id',
            'user'
        );
        $this->dropColumn('user', 'project_id');
    }
}
