<?php

use yii\db\Migration;

class m170618_103136_callcenter_permissions extends Migration
{
    public function up()
    {
        $callcenterRole = $this->auth->getRole(\common\models\User::ROLE_CALLCENTER);

        $loginToBackend = $this->auth->getPermission('loginToBackend');
        $this->auth->add($loginToBackend);
        $this->auth->addChild($callcenterRole, $loginToBackend);
    }

    public function down()
    {
        $this->auth->remove($this->auth->getPermission('loginToBackend'));
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
