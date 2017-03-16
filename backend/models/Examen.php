<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "examen".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property Pregunta[] $preguntas
 */
class Examen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPregunta()
    {
        return $this->hasMany(Pregunta::className(), ['idexamen' => 'id']);
    }
}
