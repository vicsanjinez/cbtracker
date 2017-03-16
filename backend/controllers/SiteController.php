<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'language'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','set-cookie','show-cookie'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //Yii::$app->Util->hello();

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSetCookie()
    {
        $cookie = new yii\web\Cookie([
            'name' => 'test',
            'value' => 'test cookie ',
            ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionShowCookie()
    {
        if(Yii::$app->getRequest()->getCookies()->has('test'))
        {
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }

    private function setCookieLanguage($name, $value)
    {
        $cookie = new yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionLanguage()
    {
        if(isset($_POST['lang']))
        {
            Yii::$app->language = $_POST['lang'];

            //print_r($_POST['lang']);
            //die();

            //setCookieLanguage('lang', $_POST['lang']);

            $cookie = new yii\web\Cookie([
            'name' => 'lang',
            'value' => $_POST['lang'],
            ]);

            Yii::$app->getResponse()->getCookies()->add($cookie);


        }
    }
}
