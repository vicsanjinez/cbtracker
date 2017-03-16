<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departament".
 *
 * @property integer $id
 * @property string $name
 * @property string $datecreated
 * @property integer $status
 * @property integer $idbranch
 * @property integer $idcompany
 *
 * @property Branch $idbranch0
 * @property Company $idcompany0
 */
class Departament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departament';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'datecreated', 'status', 'idbranch', 'idcompany'], 'required'],
            [['datecreated'], 'safe'],
            [['status', 'idbranch', 'idcompany'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['idbranch'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['idbranch' => 'id']],
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
            'datecreated' => 'Datecreated',
            'status' => 'Status',
            'idbranch' => 'Idbranch',
            'idcompany' => 'Idcompany',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'idbranch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'idcompany']);
    }
}
