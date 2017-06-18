<?php

use yii\db\Migration;
use common\models\User;

class m170618_103136_callcenter_permissions extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $callcenterRole = $auth->getRole(User::ROLE_CALLCENTER);

        $loginToBackend = $auth->getPermission('loginToBackend');
        $auth->addChild($callcenterRole, $loginToBackend);
    }

    public function down()
    {
//        $auth = Yii::$app->authManager;
//
//        $this->auth->remove($auth->getPermission('loginToBackend'));
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
