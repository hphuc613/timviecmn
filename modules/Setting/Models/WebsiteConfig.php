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

    const WEBSITE_PHONE_FOR_RECRUIMENT = 'WEBSITE_PHONE_FOR_RECRUIMENT';

    const WEBSITE_PHONE_FOR_APPLICANT = 'WEBSITE_PHONE_FOR_APPLICANT';

    const WEBSITE_EMAIL = 'WEBSITE_EMAIL';

    const WEBSITE_ADDRESS = 'WEBSITE_ADDRESS';

    const WEBSITE_CONFIG = [
        self::WEBSITE_LOGO,
        self::WEBSITE_FAVICON,
        self::WEBSITE_PHONE_FOR_RECRUIMENT,
        self::WEBSITE_PHONE_FOR_APPLICANT,
        self::WEBSITE_EMAIL,
        self::WEBSITE_ADDRESS
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
