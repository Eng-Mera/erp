<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 *
 * @property Products[] $products
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg', 'on'=>'update-image'],
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
            'logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['project_id' => 'id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->logo->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->logo->baseName . '.' . $this->logo->extension))
            {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

}
