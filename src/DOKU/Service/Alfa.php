<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorTenant;

class Alfa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/alfa-virtual-account/v2/payment-code';
        return PaycodeGeneratorTenant::post($config, $params);
    }
}
