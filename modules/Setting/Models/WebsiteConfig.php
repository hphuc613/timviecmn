<?php

namespace Modules\Setting\Models;

/**
 * Class WebsiteConfig
 *
 * @package Modules\Setting\Model
 */
class WebsiteConfig extends Setting{

    const WEBSITE_LOGO = 'WEBSITE_LOGO';

    const WEBSITE_FAVICON = 'WEBSITE_FAVICON';

    const WEBSITE_CONFIG = [
        self::WEBSITE_LOGO,
        self::WEBSITE_FAVICON,
    ];

    /**
     * @return array
     */
    public static function getWebsiteConfig(){
        $website_config = [];
        foreach (self::WEBSITE_CONFIG as $item){
            $website_config[$item] = self::getValueByKey($item);
        }

        return $website_config;
    }
}
