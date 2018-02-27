<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\clicker\entities\BadDomain */

$this->title = 'Create Bad Domain';
$this->params['breadcrumbs'][] = ['label' => 'Bad Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bad-domain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
