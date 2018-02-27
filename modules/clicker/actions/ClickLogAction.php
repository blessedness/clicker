<?php

namespace app\modules\clicker\actions;

use app\modules\clicker\entities\Click;
use app\modules\clicker\helpers\ClickHelper;
use app\modules\clicker\repositories\ClickRepository;
use app\modules\clicker\repositories\DomainRepository;
use app\modules\clicker\services\ClickService;
use yii\base\Action;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Request;

class ClickLogAction extends Action
{
    /**
     * @var ClickRepository
     */
    private $clickRepository;

    /**
     * @var ClickService
     */
    private $clickService;

    /**
     * @var DomainRepository
     */
    public $domainRepository;

    /**
     * @var Controller
     */
    public $controller;

    /**
     * ClickLogFilter constructor.
     * @param string $id
     * @param Controller $controller
     * @param ClickRepository $clickRepository
     * @param ClickService $clickService
     * @param DomainRepository $domainRepository
     * @param array $config
     */
    public function __construct(
        string $id,
        Controller $controller,
        ClickRepository $clickRepository,
        ClickService $clickService,
        DomainRepository $domainRepository,
        array $config = [])
    {
        $this->controller = $controller;
        $this->clickRepository = $clickRepository;
        $this->clickService = $clickService;
        $this->domainRepository = $domainRepository;
        parent::__construct($id, $controller, $config);
    }

    /**
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function run()
    {
        $params = \Yii::$app->request->getQueryParams();

        $params1 = $params['param1'];

        /** @var $request Request */
        $request = \Yii::$app->request;

        if ($request->referrer === null) {
            throw new HttpException(417, 'Referer domain does not find');
        }

        $referer = ClickHelper::getDomain($request->referrer);

        if (($clickModel = $this->clickRepository->getByParams($params1, $referer)) === null) {

            $model = new Click();
            $model->ua = $request->userAgent;
            $model->ip = $request->userIP;
            $model->ref = $referer;
            $model->param1 = $params1;
            $model->param2 = $params['param2'];
            $model->id = uniqid(time(), false);
            $model->error = 0;
            $model->bad_domain = 0;

            $clickModel = $this->clickService->create($model);

            return $this->controller->redirect(['default/success', 'id' => $clickModel->id]);
        } else {

            if ($this->domainRepository->exist($referer)) {
                $this->clickService->badDomainIncrement($clickModel->id);
                \Yii::$app->session->setFlash('needRedirect');
            }

            $this->clickService->errorIncrement($clickModel->id);

            return $this->controller->redirect(['default/error', 'id' => $clickModel->id]);
        }
    }
}