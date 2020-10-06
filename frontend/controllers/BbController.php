<?php

namespace frontend\controllers;

use Yii;
use frontend\models\BorrowedBook;
use frontend\models\BorrowedBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BbController implements the CRUD actions for BorrowedBook model.
 */
class BbController extends Controller
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
     * Lists all BorrowedBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BorrowedBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorrowedBook model.
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
     * Creates a new BorrowedBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BorrowedBook();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($this->bookUpdate($model->bookId)){
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    
    public function bookUpdate($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE book SET status=1 WHERE bookId='.$bookId);
        $command->execute();
        return true;
    }
    /**
     * Updates an existing BorrowedBook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bbId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BorrowedBook model.
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
     * Finds the BorrowedBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorrowedBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorrowedBook::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
