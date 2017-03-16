<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

use backend\models\AuthAssignment;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $firstname;
    public $lastname;

    public $permission;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['firstname', 'required','message'=>'Firstname is required, please fill it'],
            ['lastname', 'required'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;

        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;

        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
        

        $permissionList = $_POST['SignupForm']['permission'];
        
        foreach ($permissionList as $value) 
        {
            $newPermission = new AuthAssignment;
            $newPermission->user_id = $user->id;
            $newPermission->item_name = $value;
            $newPermission->save();
            // var_dump($newPermission->getErrors());
            // die();
        }

        return $user;
        
    }
}
