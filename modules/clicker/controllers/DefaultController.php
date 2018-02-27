<?php

namespace app\modules\clicker\controllers;

use app\modules\clicker\entities\{
    Click, ClickSearch
};
use app\modules\clicker\repositories\ClickRepository;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `clicker` module
 */
class DefaultController extends Controller
{
    /**
     * @var ClickRepository
     */
    private $clickRepository;

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'click' => [
                'class' => 'app\modules\clicker\actions\ClickLogAction',
            ],
        ];
    }

    /**
     * DefaultController constructor.
     * @param string $id
     * @param Module $module
     * @param ClickRepository $clickRepository
     * @param array $config
     */
    public function __construct(string $id, Module $module, ClickRepository $clickRepository, array $config = [])
    {
        $this->clickRepository = $clickRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $searchModel = \Yii::createObject(ClickSearch::class);
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param string $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionError(string $id)
    {
        $model = $this->findModel($id);

        $isRedirect = false;
        $timeout = 5;
        $http = 'https://google.com';

        if (\Yii::$app->session->getFlash('needRedirect')) {
            $isRedirect = true;

            \Yii::$app->view->registerMetaTag(['http-equiv' => 'refresh', 'content' => "{$timeout};url={$http}"]);
        }

        return $this->render('error', compact('model', 'isRedirect', 'timeout', 'http'));
    }

    /**
     * @param string $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSuccess(string $id)
    {
        return $this->render('success', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Finds the click model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Click the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->clickRepository->getById($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
