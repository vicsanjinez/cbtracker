<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $zipcode
 * @property string $city
 * @property string $province
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'zipcode', 'city', 'province'], 'required'],
            [['nombre', 'zipcode', 'city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'zipcode' => 'Zipcode',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
