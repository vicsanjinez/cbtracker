<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $id
 * @property string $zipcode
 * @property string $city
 * @property string $province
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipcode', 'city', 'province'], 'required'],
            [['zipcode', 'city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zipcode' => 'Zipcode',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
