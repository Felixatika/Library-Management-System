<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use frontend\models\Book;
use frontend\models\BorrowedBook;
use frontend\models\Student;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorrowedBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'BOOKBAR LMS';
$this->params['breadcrumbs'][] = $this->title;
$totalBooks = Book::find()->asArray()->all();
$bb = BorrowedBook::find()->asArray()->all();
$totalBorrowedBooks = BorrowedBook::find()->asArray()->all();

$totalStudents = Student::find()->asArray()->all();
$overdue = BorrowedBook::find()->where('expectedReturnDate < '.date('yy/m/d'))->andWhere(['actualReturnDate'=>NULL])->asArray()->all();
?>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL BOOKS</span>
              <span class="info-box-number"><?= count($bb)?><small></small></span>
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
              <span class="info-box-number"><?= count($totalBorrowedBooks)?></span>
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
              <span class="info-box-number"><?= count($overdue)?></span>
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
              <span class="info-box-number"><?= count($totalStudents)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
        	<div style="padding-top: 20px;">
        	   <button type="button" class="btn btn-block btn-success btn-lg assighnbook" style="width: 300px;"><i class="fa fa-plus" aria-hidden="true"></i> Assighn a Book</button>
            </div>
            <div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOK ASSIGNMENTS</strong></h2>
            </div>
              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                      <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
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
                        [
                            'label'=>'Return Book',
                            'format' => 'html',
                            'value' => function ($dataProvider) {
                            return '<span class="btn btn-danger">Return</span>';
                            },
                            
                        ],
                        //'actualReturnDate',
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
<?php
        Modal::begin([
            'header'=>'<h4>Assighn A Book</h4>',
            'id'=>'assignbook',
            'size'=>'modal-lg'
            ]);
        echo "<div id='assignbookContent'></div>";
        Modal::end();
      ?>