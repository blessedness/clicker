<?php
/**
 * Created by Yuriy Hritsaiy.
 * Email: yu.hritsaiy@gmail.com
 */

namespace app\modules\clicker\repositories;


use app\modules\clicker\entities\Click;

class ClickRepository
{
    /**
     * @param string $id
     * @return Click|null
     */
    public function getById(string $id)
    {
        return Click::find()->where(['id' => $id])->one();
    }

    /**
     * Check is param1 unique
     *
     * @param string $value of param1
     * @param string $referer
     * @return Click|null
     */
    public function getByParams(string $value, string $referer)
    {
        return Click::find()->where(['param1' => $value, 'ref' => $referer])->limit(1)->one();
    }
}