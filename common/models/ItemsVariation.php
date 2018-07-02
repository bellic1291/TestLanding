<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\ItemsPhoto;

class ItemsVariation extends \yii\db\ActiveRecord
{
    const STATUS_NOT_AVAILABLE = 0;
    const STATUS_FOR_QUERY = 1;
    const STATUS_AVAILABLE = 2;
    
    public static function tableName()
    {
        return 'items_variation';
    }

    public function rules()
    {
        return [
            [['item_id', 'price', 'availability'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'name' => 'Наименование',
            'price' => 'Цена',
            'availability' => 'Доступность',
        ];
    }

    public function getItemsPhotos()
    {
        return $this->hasMany(ItemsPhoto::className(), ['item_variation_id' => 'id']);
    }

    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
    
    public static function getStatusNameById($status) 
    {
        return  ArrayHelper::getValue(self::getStatusesArray(), $status);;
    }
    
    public static function getStatusesArray($html = true)
    {
        $array = [
            [
             'id' => self::STATUS_NOT_AVAILABLE, 
             'html_title'=> '<span class="glyphicon glyphicon-remove text-danger"></span> Нет в наличии', 
             'title'=> 'Файл отклонён'
            ],
            [
             'id' => self::STATUS_FOR_QUERY, 
             'html_title'=> '<span class="glyphicon glyphicon-time text-warning"></span> Только под заказ', 
             'title'=> 'Файл ожидает подтверждения'
            ],
            [
             'id' => self::STATUS_AVAILABLE, 
             'html_title'=> '<span class="glyphicon glyphicon-ok text-success"></span> В наличии', 
             'title'=> 'Файл подтверждён'
            ],
        ];
        return ArrayHelper::map($array, 'id', $html ? 'html_title' : 'title');
    }
    
    public static function getOnePhotoPathById($id) 
    {
        $photo = ItemsPhoto::find()->where(['item_variation_id' => $id])->one(); 
        return $photo->photo_path; 
    }
    
    public static function getDataProvider($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => static::find()->where(['item_id' => $id])->orderBy('price ASC'),
            'sort' =>false,
        ]);
        return $dataProvider;
    }
    
    public function getLowerPriceOfItem($id)
    {
        $cheapest = self::find()->where(['item_id' => $id])->orderBy('price ASC')->one();
        return $cheapest['price'];
    }
}
