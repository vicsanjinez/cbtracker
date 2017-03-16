<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $id
 * @property string $receivername
 * @property string $receiveremail
 * @property string $subject
 * @property string $content
 * @property string $attachment
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receivername', 'receiveremail', 'subject', 'content', 'attachment'], 'required'],
            [['receivername', 'receiveremail', 'subject', 'content', 'attachment'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receivername' => 'Receivername',
            'receiveremail' => 'Receiveremail',
            'subject' => 'Subject',
            'content' => 'Content',
            'attachment' => 'Attachment',
        ];
    }
}
