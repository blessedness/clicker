<?php
/**
 * Created by Yuriy Hritsaiy.
 * Email: yu.hritsaiy@gmail.com
 */

namespace app\modules\clicker\helpers;


class ClickHelper
{
    /**
     * @param string $url
     * @return null
     */
    public static function getDomain(string $url)
    {
        preg_match('/^(?:https?:\/\/)?(?:www\.)?([^:\/\n]+)/', $url, $matches);

        return $matches[1] ?? null;
    }
}