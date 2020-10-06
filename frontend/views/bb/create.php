<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */

$this->title = 'Create Borrowed Book';
$this->params['breadcrumbs'][] = ['label' => 'Borrowed Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowed-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
