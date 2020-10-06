<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */

$this->title = 'Update Borrowed Book: ' . $model->bbId;
$this->params['breadcrumbs'][] = ['label' => 'Borrowed Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bbId, 'url' => ['view', 'id' => $model->bbId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrowed-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
