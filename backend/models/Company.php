<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $datecreated
 * @property integer $status
 *
 * @property Branch[] $branches
 * @property Departament[] $departaments
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'address', 'datecreated', 'status', 'datestart'], 'required'],
            [['datecreated', 'datestart'], 'safe'],
            [['status'], 'integer'],
            //[['file'], 'file'],
            [['file'], 'image', 'minWidth'=>'1024', 'minHeight'=>'1024'],
            [['name', 'email', 'address'], 'string', 'max' => 100],
            [['logo'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'datecreated' => 'Datecreated',
            'status' => 'Status',
            'datestart' => 'Datestart',
            'file' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branch::className(), ['idcompany' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartaments()
    {
        return $this->hasMany(Departament::className(), ['idcompany' => 'id']);
    }
}
