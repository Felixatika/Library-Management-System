<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Book;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
            <div class="box-header with-border">
            <?php if(Yii::$app->user->can('student')){?>
              <?= Html::a('Borrow Book', ['borrowBook'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            <?php if(Yii::$app->user->can('librarian')){?>
              <?= Html::a('Add Book', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            

          
              <div style="text-align: center;">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bookId',
            'bookName',
            'referenceNo',
            'publisher',
            'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>
    

    <?php
        Modal::begin([
            'header'=>'<h4> ADD AUTHOR </h4>',
            'id'=>'addauthor',
            'size'=>'modal-lg'
            ]);
        echo "<div id='addauthorContent'></div>";
        Modal::end();
      ?>
     