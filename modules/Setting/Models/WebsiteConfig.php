<?php

namespace Modules\Setting\Models;

use function Symfony\Component\String\s;

/**
 * Class WebsiteConfig
 *
 * @package Modules\Setting\Model
 */
class WebsiteConfig extends Setting{

    const WEBSITE_TITLE = 'WEBSITE_TITLE';

    const WEBSITE_LOGO = 'WEBSITE_LOGO';

    const WEBSITE_FAVICON = 'WEBSITE_FAVICON';

    const WEBSITE_PHONE_FOR_RECRUIMENT = 'WEBSITE_PHONE_FOR_RECRUIMENT';

    const WEBSITE_PHONE_FOR_APPLICANT = 'WEBSITE_PHONE_FOR_APPLICANT';

    const WEBSITE_COMPANY_NAME = 'WEBSITE_COMPANY_NAME';

    const WEBSITE_EMAIL = 'WEBSITE_EMAIL';

    const WEBSITE_ADDRESS = 'WEBSITE_ADDRESS';

    const WEBSITE_SLOGAN = 'WEBSITE_SLOGAN';

    const WEBSITE_SLOGAN_RECRUIT = 'WEBSITE_SLOGAN_RECRUIT';

    const WEBSITE_CONFIG = [
        self::WEBSITE_TITLE,
        self::WEBSITE_LOGO,
        self::WEBSITE_FAVICON,
        self::WEBSITE_PHONE_FOR_RECRUIMENT,
        self::WEBSITE_PHONE_FOR_APPLICANT,
        self::WEBSITE_COMPANY_NAME,
        self::WEBSITE_EMAIL,
        self::WEBSITE_ADDRESS,
        self::WEBSITE_SLOGAN,
        self::WEBSITE_SLOGAN_RECRUIT
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
