<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $foto
 * @property string $localizacion
 * @property string $fechacreacion
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'localizacion', 'fechacreacion'], 'required'],
            [['nombre', 'foto', 'localizacion'], 'string'],
            [['fechacreacion'], 'safe'],
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
            'foto' => 'Foto',
            'localizacion' => 'Localizacion',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    public function getMensaje()
    {
        return $this->hasMany(Mensaje::className(), ['idusuario' => 'id']);
    }
}
