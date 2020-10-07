<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Student;
use frontend\models\Book;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */
$sudents = ArrayHelper::map(Student::find()->all(), 'studentsId', 'fullName');
$books = ArrayHelper::map(Book::find()->where(['status'=>0])->all(), 'bookId', 'bookName');
?>
<div class="borrowed-book-form">
    <?php $form = ActiveForm::begin(['id' => 'bb-create']); ?>
    
    
    <?= $form->field($model, 'studentId')->dropDownList($sudents,['disabled' => true]) ?>
    <?= $form->field($model, 'bookId')->dropDownList($books,['disabled' => true]) ?>
     <?= $form->field($model, 'actualReturnDate')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>
    <?= $form->field($model, 'borrowDate')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'expectedReturnDate')->textInput(['disabled' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>