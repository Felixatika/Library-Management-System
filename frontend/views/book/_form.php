<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Author;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
/* @var $form yii\widgets\ActiveForm */
$authors = ArrayHelper::map(Author::find()->all(), 'authorId', 'authorName', 'referenceNumber');
?>
<div class="row">
    <div class="book-form">

            <?php $form = ActiveForm::begin(); ?>
 		<div class="col-xs-12">
        <?= $form->field($model, 'bookName')->textInput(['maxlength' => true,'placeholder'=>'Input Book Name'])->label(false)?>
        </div>
       <div class="col-xs-10">
         <?= $form->field($bookAuthor, 'authorId')->dropDownList($authors,['placeholder'=>'Select Book Name'])->label(false) ?>
       </div>
       <div class="col-xs-2">
            
       		<button type="button" class="btn btn-block btn-success addauthor"><i class="fa fa-plus" aria-hidden="true"></i> Add Author</button>
       </div>  
        <div class="col-xs-12">  
        	<?= $form->field($model, 'referenceNo')->textInput(['maxlength' => true,'placeholder'=>'Input Reference NO'])->label(false) ?>
       </div>
 		<div class="col-xs-12">        
 			<?= $form->field($model, 'publisher')->textInput(['maxlength' => true,'placeholder'=>'Input Publisher'])->label(false)?>
    	</div>
      	<div class="col-xs-12">        
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success  float-right']) ?>
            </div>
    	</div>
        <?php ActiveForm::end(); ?>
    
    </div>
</div>
    




















