<?php

/* @var $this yii\web\View */

/* @var $name string */
/* @var $http string */
/* @var $isRedirect boolean */
/* @var $timeout integer */

/* @var $model \app\modules\clicker\entities\Click */

use yii\helpers\Html;

$this->title = 'An error has occurred';
?>
<div class="clicker-default-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <p>
            <strong>ID:</strong> <?= $model->id ?>
        </p>
        <p>
            Invalid link.
        </p>
    </div>

    <?php if ($isRedirect): ?>
        After <?= $timeout ?> seconds you will redirect to <?= Html::encode($http) ?>
    <?php endif; ?>

    <p>
        <?= Html::a('Home', \Yii::$app->defaultRoute, ['class' => 'btn btn-primary']) ?>
    </p>

</div>
