<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $logo_mockup
 * @property string $phone
 * @property string $acc_num
 * @property string $city
 * @property string $country
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
            [['phone','acc_num','city','country'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg', 'on'=>'update-image'],
            [['logo_mockup'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg', 'on'=>'update-image'],
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
            if (!empty($this->logo) and (is_object($this->logo)) and !empty($this->logo_mockup) and (is_object($this->logo_mockup)))
            {
                if (($this->logo->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->logo->baseName . '.' . $this->logo->extension)) and ($this->logo_mockup->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->logo_mockup->baseName . '.' . $this->logo_mockup->extension)))
                {
                    return true;
                }

            }
            elseif (!empty($this->logo) and (is_object($this->logo)))
            {
                if ($this->logo->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->logo->baseName . '.' . $this->logo->extension))
                {
                    return true;
                }
            }
            elseif (!empty($this->logo_mockup) and (is_object($this->logo_mockup)))
            {
                if ($this->logo_mockup->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->logo_mockup->baseName . '.' . $this->logo_mockup->extension))
                {
                    return true;
                }
            }

            return false;
        } else {
            return false;
        }
    }

}
