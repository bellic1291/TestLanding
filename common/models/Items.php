<?php

namespace common\models;

use Yii;
use common\models\ItemsVariation;

class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'photo_path'], 'string', 'max' => 255],
            [['description', 'characteristics'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'characteristics' => 'Характеристики',
            'photo_path' => 'Фотография',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsVariations()
    {
        return $this->hasMany(ItemsVariation::className(), ['item_id' => 'id']);
    }
    
    public function getLowerPrice()
    {
        return ItemsVariation::getLowerPriceOfItem($this->id);
    }
    
    public static function getItems() 
    {
        return static::find()->cache(100)->all();
    }
}
