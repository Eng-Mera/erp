<?php

use yii\db\Migration;

class m170630_001949_alter_projects_table extends Migration
{
    public function up()
    {
        $this->addColumn('projects', 'logo_mockup', $this->string()->null());
        $this->addColumn('projects', 'phone', $this->string()->null());
        $this->addColumn('projects', 'acc_num', $this->string()->null());
        $this->addColumn('projects', 'city', $this->string()->null());
        $this->addColumn('projects', 'country', $this->string()->null());

    }

    public function down()
    {
        $this->dropColumn('projects', 'logo_mockup');
        $this->dropColumn('projects', 'phone');
        $this->dropColumn('projects', 'acc_num');
        $this->dropColumn('projects', 'city');
        $this->dropColumn('projects', 'country');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
