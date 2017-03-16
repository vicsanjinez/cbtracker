<?php

namespace backend\modules\settings\models;

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
 * @property string $datestart
 *
 * @property Branch[] $branches
 * @property Departament[] $departaments
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            ['datestart', 'checkDate'],
            [['status'], 'integer'],
            [['name', 'email', 'address'], 'string', 'max' => 100],
        ];
    }

    public function checkDate($attribute, $params)
    {
        $today = date('Y-m-d');
        $selectedDate = date($this->datestart);
        if($selectedDate > $today)
        {
            $this->addError($attribute, 'Date Start must be small');
        }
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
