<?php

use yii\db\Migration;
use common\models\User;

class m170618_092818_add_roles extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
    
        $callcenter = $auth->createRole(User::ROLE_CALLCENTER);
        $auth->add($callcenter);
        $auth->assign($callcenter, 4);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getRole(User::ROLE_CALLCENTER));

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
