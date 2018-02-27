<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\clicker\entities\BadDomain */

$this->title = 'Update Bad Domain: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bad Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bad-domain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
