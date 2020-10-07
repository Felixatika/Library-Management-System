<?php

use yii\helpers\Html;
use frontend\models\Borrowedbook;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */

$this->title = 'Update Borrowedbook: ' . $model->bbId;
$this->params['breadcrumbs'][] = ['label' => 'Borrowedbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bbId, 'url' => ['view', 'id' => $model->bbId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrowedbook-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
