<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */

$this->title = 'Create Borrowedbook';
$this->params['breadcrumbs'][] = ['label' => 'Borrowedbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowedbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
