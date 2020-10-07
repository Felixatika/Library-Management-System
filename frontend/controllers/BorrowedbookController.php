<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Book;
use frontend\models\BorrowedbookSearch;
use frontend\models\Bookauthor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use frontend\models\Borrowedbook;

/**
 * BorrowedbookController implements the CRUD actions for Borrowedbook model.
 */
class BorrowedbookController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Borrowedbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BorrowedbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Borrowedbook model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Borrowedbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Borrowedbook();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bbId]);
        }

        return $this->renderAjax('assignbook', [
            'model' => $model,
        ]);
    }

    // public function actionReturnbook($id){

    //     $model = new Borrowedbook();
    //     $searchModel = new BorrowedbookSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         $this->updateAfterDelete($model->bookId);
    //         return $this->redirect(['index']);
    //     }
    // }
    /**
     * Updates an existing Borrowedbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new Borrowedbook();
        $searchModel = new BorrowedbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->bbId]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    public function actionReturnbook($id){

        $model = new Borrowedbook();
        $searchModel = new BorrowedbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->updateAfterDelete($model->bookId);
            return $this->redirect(['index']);
        }
        
        return $this->renderAjax('returnbook',[
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }
    /**
     * Deletes an existing Borrowedbook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $bookId = BorrowedBook::find()->where(['bbId'=>$id])->one();
        $this->findModel($id)->delete();
        $this->updateAfterDelete($bookId->bookId);
        return $this->redirect(['index']);
    }
    
    public function updateAfterDelete($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE book SET status=0 WHERE bookId='.$bookId);
        $command->execute();
        return true;
    }


    /**
     * Finds the Borrowedbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Borrowedbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Borrowedbook::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
