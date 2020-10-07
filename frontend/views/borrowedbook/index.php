<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Student;
use frontend\models\Borrowedbook;
use frontend\models\BorrowedbookSearch;
use frontend\models\Book;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorrowedbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


// $this->params['breadcrumbs'][] = $this->title;
$this->title = 'BOOKBAR LMS';
$totalstudents= Student::find()->asArray()->all();
$totalBooks=Book::find()->asArray()->all();
$borrowedBooks=Borrowedbook::find()->asArray()->all();
$searchModel = new BorrowedbookSearch();
?>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL BOOKS</span>
              <span class="info-box-number"><?=count($totalBooks) ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">BORROWED BOOKS</span>
              <span class="info-box-number"><?= count($borrowedBooks)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">OVERDUE BOOKS</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL STUDENTS</span>
              <span class="info-box-number"><?=count($totalstudents)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
   <?php if(Yii::$app->user->can('librarian')){?>
        <?= Html::a('Assign Book', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
<?php }?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->user->can('librarian')){?>
    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'bbId',
                        [
                            'attribute' => 'studentId',
                            'value' => function ($dataProvider) {
                                $studentName = Student::find()->where(['studentsId'=>$dataProvider->studentId])->One();
                                return $studentName->fullName;
                            },
                        ],
                        [
                            'attribute' => 'bookId',
                            'value' => function ($dataProvider) {
                            $studentName = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            return $studentName->bookName;
                            },
                        ],
                        [
                            'attribute' => 'borrowDate',
                            'value' => function ($dataProvider) {
                                $date = new DateTime($dataProvider->borrowDate);
                                return $date->format('F j, Y,');
                            },
                        ],
                        [
                            'attribute' => 'expectedReturnDate',
                            'value' => function ($dataProvider) {
                            $date = new DateTime($dataProvider->expectedReturnDate);
                            return $date->format('F j, Y,');
                            },
                        ],
                        'actualReturnDate',
                        
                        [
                          
                            'label'=>'Return Book',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                            return '<span val="'.$dataProvider->bbId.'" class="btn btn-danger returnbook"> Return </span>';
                            },
                            
                        ],

                        [
                          'label'=>'Status',
                          'format' => 'raw',
                          'value' => function ($dataProvider) {
                              $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                              if($bookStatus->status == 0){
                                  $status = 'Available';
                              }elseif ($bookStatus->status == 1){
                                  $status = 'Issued';
                              }elseif ($bookStatus->status == 2){
                                  $status = 'Pending';
                              }
                              return '<span class="btn btn-info">'.$status.'</span>';
                          },
                          
                      ],
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); }?>

<?php if(Yii::$app->user->can('student')){?>
    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        //'bbId',
                        [
                            'attribute' => 'studentId',
                            'value' => function ($dataProvider) {
                                $studentName = Student::find()->where(['studentsId'=>$dataProvider->studentId])->One();
                                return $studentName->fullName;
                            },
                        ],
                        [
                            'attribute' => 'bookId',
                            'value' => function ($dataProvider) {
                            $studentName = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            return $studentName->bookName;
                            },
                        ],
                        [
                            'attribute' => 'borrowDate',
                            'value' => function ($dataProvider) {
                                $date = new DateTime($dataProvider->borrowDate);
                                return $date->format('F j, Y,');
                            },
                        ],
                        [
                            'attribute' => 'expectedReturnDate',
                            'value' => function ($dataProvider) {
                            $date = new DateTime($dataProvider->expectedReturnDate);
                            return $date->format('F j, Y,');
                            },
                        ],
                        'actualReturnDate',

                        [
                          'label'=>'Status',
                          'format' => 'raw',
                          'value' => function ($dataProvider) {
                              $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                              if($bookStatus->status == 0){
                                  $status = 'Available';
                              }elseif ($bookStatus->status == 1){
                                  $status = 'Issued';
                              }elseif ($bookStatus->status == 2){
                                  $status = 'Pending';
                              }
                              return '<span class="btn btn-info">'.$status.'</span>';
                          },
                          
                      ],
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); }?> 
            <?php
             Modal::begin([
            'header'=>'<h4>Return Book</h4>',
             'id'=>'returnbook',
            'size'=>'modal-md'
            ]);
            echo "<div id='returnbookContent'></div>";
            Modal::end();
           ?>
<?php
Modal::begin([
            'header'=>'<h4>Assign A Book</h4>',
            'id'=>'assignbook',
            'size'=>'modal-lg'
            ]);
        echo "<div id='assignbookContent'></div>";
        Modal::end();
        ?>