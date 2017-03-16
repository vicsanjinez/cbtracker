<?php

namespace backend\controllers;

use Yii;
use backend\models\Branch;
use backend\models\BranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\ForbiddenHttpException;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class BranchController extends Controller
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
     * Lists all Branch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        
        if(Yii::$app->request->post('hasEditable'))
        {
            $idbranch = Yii::$app->request->post('editableKey');
            $branch = Branch::findOne($idbranch);

            $out = Json::encode(['output' => '', 'message' => '']);

            $post = [];
            $posted = current($_POST['Branch']);
            $post['Branch'] = $posted;

            if($branch->load($post))
            {
                $branch->save();
                $output = 'myvalue';
                $out = Json::encode(['output' => $output, 'message' => '']);                
            }

            echo $out;
            return ;
        }
        else
        {
            //var_dump('nada');
            //die();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branch model.
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
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-branch'))
        {
            $model = new Branch();

            if ($model->load(Yii::$app->request ->post())) 
            {
                $model->datecreated = date('Y-m-d h:m:s');
                 if($model->save())
                 {
                    echo 1;
                 }
                 else
                 {
                    echo 0;
                 }
                //return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Branch model.
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
     * Finds the Branch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLists($id)
    {
        $countBranches = Branch::find()
                        ->where(['idcompany'=>$id])
                        ->count();

        $branches = Branch::find()
                        ->where(['idcompany'=>$id])
                        ->all();

        if($countBranches > 0)
        {
            foreach ($branches as $branch) 
            {
                # code...
                echo "<option value='".$branch->id."'>".$branch->name."</option>";
            }
        }
        else
        {
            echo "<option></option>";
        }
    }

    public function actionImportExcel()
    {
        $inputFile = 'uploads/archivoexcel.xlsx';
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            die('error');
        } 

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row=1; $row <= $highestRow; $row++) { 
            # code...
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL, TRUE, FALSE);

            if($row == 1)
            {
                continue;
            }

            /*
            $branch = new Branch();

            $branch->id = $rowData[0][0];
            $branch->name = $rowData[0][1];
            $branch->address = $rowData[0][2];
            $branch->datecreated = $rowData[0][3];
            $branch->status = $rowData[0][4];
            $branch->idcompany = $rowData[0][5];

            $branch->save();

            print_r($branch->getErrors());
            */

            if(!empty($rowData[0][0]))
            {
                $data[] = [
                        $rowData[0][0],
                        $rowData[0][1],
                        $rowData[0][2],
                        $rowData[0][3],
                        $rowData[0][4],
                        $rowData[0][5],
                      ];    
            }
        }

        print_r($data);

        Yii::$app->db->createCommand()->batchInsert('branch',['id','name','address','datecreated','status','idcompany'],$data)->execute();
    }

    public function actionValidation()
    {
        $model = new Branch;
        if(Yii::$app->request->isAjax &&
                $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    public function actionUpload()
    {
        $fileName = 'file';
        $uploadPath = 'uploads';
 
        if (isset($_FILES[$fileName])) 
        {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);

            if ($file->saveAs($uploadPath . '/' . $file->name)) 
            {
                //Now save file data to database

                echo \yii\helpers\Json::encode($file);
            }
        }
        else
        {
            return $this->render('upload');
        }

        return false;
    }

    public function actionMultipleDatabase()
    {
        $comments = Yii::$app->db2->createCommand("SELECT * FROM comment")->queryAll();

        print_r($comments);
        
    }
}
