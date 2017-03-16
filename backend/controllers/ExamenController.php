<?php

namespace backend\controllers;

use Yii;
use backend\models\Examen;
use backend\models\ExamenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\Pregunta;
use backend\models\Model;
use yii\helpers\ArrayHelper;

/**
 * ExamenController implements the CRUD actions for Examen model.
 */
class ExamenController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Examen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExamenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Examen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Examen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Examen();
        $modelsPregunta = [new Pregunta];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsPregunta = Model::createMultiple(Pregunta::classname());
            Model::loadMultiple($modelsPregunta, Yii::$app->request->post());

            // ajax validation
            // if (Yii::$app->request->isAjax) {
            //     Yii::$app->response->format = Response::FORMAT_JSON;
            //     return ArrayHelper::merge(
            //         ActiveForm::validateMultiple($modelsPregunta),
            //         ActiveForm::validate($model)
            //     );
            // }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPregunta) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPregunta as $modelPregunta) {
                            $modelPregunta->idexamen = $model->id;
                            if (! ($flag = $modelPregunta->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPregunta' => (empty($modelsPregunta)) ? [new Pregunta] : $modelsPregunta
            ]);
        }
    }

    /**
     * Updates an existing Examen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        //$model->pregunta es la RELACION entre examen y pregunta
        $modelsPregunta = $model->pregunta;
        //var_dump($modelsPregunta);

        if ($model->load(Yii::$app->request->post()))
        {

            $oldIDs = ArrayHelper::map($modelsPregunta, 'id', 'id');
            $modelsPregunta = Model::createMultiple(Pregunta::classname(), $modelsPregunta);
            Model::loadMultiple($modelsPregunta, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPregunta, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPregunta),
                    ActiveForm::validate($model)
                );
            }

             // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPregunta) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Pregunta::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPregunta as $modelPregunta) {
                            $modelPregunta->idexamen = $model->id;
                            if (! ($flag = $modelPregunta->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 

        return $this->render('update', [
                'model' => $model,
                'modelsPregunta' => (empty($modelsPregunta)) ? [new Pregunta] : $modelsPregunta
            ]);
            
        
    }

    /**
     * Deletes an existing Examen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Examen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Examen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Examen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
