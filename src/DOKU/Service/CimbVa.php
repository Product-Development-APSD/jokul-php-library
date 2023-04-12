<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorVa;

class CimbVa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/cimb-virtual-account/v2/payment-code';
        return PaycodeGeneratorVa::post($config, $params);
    }
}
