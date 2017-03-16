<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $respuesta
 * @property integer $idexamen
 *
 * @property Examen $idexamen0
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'respuesta'], 'required'],
            [['idexamen'], 'integer'],
            [['descripcion', 'respuesta'], 'string', 'max' => 100],
            [['idexamen'], 'exist', 'skipOnError' => true, 'targetClass' => Examen::className(), 'targetAttribute' => ['idexamen' => 'id']],
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
            'respuesta' => 'Respuesta',
            'idexamen' => 'Idexamen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamen()
    {
        return $this->hasOne(Examen::className(), ['id' => 'idexamen']);
    }
}
