<?php

namespace app\modules\clicker\repositories;

use app\modules\clicker\entities\BadDomain;

class DomainRepository
{
    /**
     * Check is domain in bad list
     *
     * @param string $domain
     * @return bool
     */
    public function exist(string $domain)
    {
        return BadDomain::find()->where(['name' => $domain])->exists();
    }
}