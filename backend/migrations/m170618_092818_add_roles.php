<?php

use yii\db\Migration;

class m170618_092818_add_roles extends Migration
{
    public function up()
    {
	$auth = Yii::$app->authManager;

	$callcenter = $auth->createRole('callcenter');
        $auth->add($callcenter);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
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
