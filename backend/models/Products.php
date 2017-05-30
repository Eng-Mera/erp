<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 * @property integer $price
 * @property integer $sale_price
 * @property integer $quantity
 * @property string $description
 * @property string $image
 *
 * @property Projects $project
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'name'], 'required'],
            [['project_id', 'price', 'sale_price', 'quantity'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'price' => 'Price',
            'sale_price' => 'Sale Price',
            'quantity' => 'Quantity',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->image->saveAs(Yii::getAlias('@uploadsDir') . '/' . $this->image->baseName . '.' . $this->image->extension))
            {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
}
