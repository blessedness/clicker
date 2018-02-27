<?php
/**
 * Created by Yuriy Hritsaiy.
 * Email: yu.hritsaiy@gmail.com
 */

namespace app\modules\clicker\services;

use app\modules\clicker\entities\Click;

class ClickService
{
    /**
     * @param Click $model
     * @return Click
     */
    public function create(Click $model)
    {
        if (!$model->save(false)) {
            throw new \RuntimeException('Saving error.');
        }

        return $model;
    }

    /**
     * @param string $id
     */
    public function errorIncrement(string $id)
    {
        Click::updateAllCounters(['error' => 1], ['id' => $id]);
    }

    /**
     * @param string $id
     */
    public function badDomainIncrement(string $id)
    {
        Click::updateAllCounters(['bad_domain' => 1], ['id' => $id]);
    }
}