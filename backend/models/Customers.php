<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone1
 * @property string $phone2
 * @property string $email
 * @property string $facebook
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $gov
 *
 * @property Orders[] $orders
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone1', 'email', 'address1', 'city', 'gov'], 'required'],
            [['name', 'phone1', 'phone2', 'email', 'facebook', 'address1', 'address2', 'city', 'gov'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'gov' => 'Gov',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'id']);
    }
}
