<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorTenant;

class Indomaret
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/indomaret-online-to-offline/v2/payment-code';
        return PaycodeGeneratorTenant::post($config, $params);
    }
}
