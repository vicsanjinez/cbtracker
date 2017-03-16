<?php

namespace backend\components;

use yii\web\Application;
use yii\base\Behavior;

class CheckIfLoggedIn extends Behavior
{
	public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'changeLanguage',
        ];
    }

    public function checkIfLoggedIn($event)
    {
        if(\Yii::$app->user->isGuest)
        {
            //echo 'your are a guest';
        }
        else
        {
            //echo 'your ar loge in';   
        }
        
        //die();
    }

    public function changeLanguage()
    {
        if(\Yii::$app->getRequest()->getCookies()->has('lang'))
        {
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
            //print_r('cambio****');
            //print_r(\Yii::$app->language);
        }
    }

}

?>