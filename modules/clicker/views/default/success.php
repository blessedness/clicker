<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $model \app\modules\clicker\entities\Click */

$this->title = 'Add new click';

$this->params['breadcrumbs'][] = ['label' => 'Clicks log', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clicker-default-success">

    <?php foreach ($model->getAttributes() as $attribute => $attribute): ?>
        <p>
            <strong><?= $attribute; ?></strong>: <?= Html::encode($attribute); ?>
        </p>
    <?php endforeach; ?>

</div>
