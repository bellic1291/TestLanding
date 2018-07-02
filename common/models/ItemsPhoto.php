<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "items_photo".
 *
 * @property int $id
 * @property int $item_variation_id
 * @property string $photo_path
 *
 * @property ItemsVariation $itemVariation
 */
class ItemsPhoto extends \yii\db\ActiveRecord
{
    const HIDDEN = 0;
    const VISIBLE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_variation_id', 'photo_path'], 'required'],
            [['item_variation_id', 'visible'], 'integer'],
            [['photo_path'], 'string', 'max' => 255],
            [['item_variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsVariation::className(), 'targetAttribute' => ['item_variation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_variation_id' => 'Item Variation ID',
            'photo_path' => 'Photo Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemVariation()
    {
        return $this->hasOne(ItemsVariation::className(), ['id' => 'item_variation_id']);
    }
}
