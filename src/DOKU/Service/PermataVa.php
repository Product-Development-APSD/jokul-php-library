<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorVa;

class PermataVa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/permata-virtual-account/v2/payment-code';
        return PaycodeGeneratorVa::post($config, $params);
    }
}
