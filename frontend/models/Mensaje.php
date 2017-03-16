<?php

namespace frontend\models;

use Yii;

use frontend\models\Usuario;

/**
 * This is the model class for table "mensaje".
 *
 * @property integer $id
 * @property string $contenido
 * @property string $fechaevaluacion
 * @property integer $estado
 * @property integer $idusuario
 * @property integer $idusuariodestino
 */
class Mensaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contenido', 'fechaevaluacion', 'estado'], 'required'],
            [['contenido'], 'string'],
            [['fechaevaluacion'], 'safe'],
            [['estado', 'idusuario', 'idusuariodestino'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contenido' => 'Contenido',
            'fechaevaluacion' => 'Fechaevaluacion',
            'estado' => 'Estado',
            'idusuario' => 'Idusuario',
            'idusuariodestino' => 'Idusuariodestino',
        ];
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idusuario']);
    }

    
}
