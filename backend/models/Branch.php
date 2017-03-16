<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $datecreated
 * @property integer $status
 * @property integer $idcompany
 *
 * @property Company $idcompany0
 * @property Departament[] $departaments
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'datecreated', 'idcompany'], 'required'],
            [['datecreated'], 'safe'],
            [['status', 'idcompany'], 'integer'],
            ['name', 'unique'],
            ['status','required','when'=>function($model){
                return (!empty($model->address)) ? true:false;
            },'whenClient' => "function(){
                if($('#address').val() === undefined)
                {
                    false;
                }
                else
                {
                    true;
                }
            }"],
            [['name', 'address'], 'string', 'max' => 100],
            [['idcompany'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['idcompany' => 'id']],
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
            'address' => 'Address',
            'datecreated' => 'Datecreated',
            'status' => 'Status',
            'idcompany' => 'Idcompany',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'idcompany']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartaments()
    {
        return $this->hasMany(Departament::className(), ['idbranch' => 'id']);
    }
}
