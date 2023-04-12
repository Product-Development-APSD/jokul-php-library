<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorVa;

class BniVa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/bni-virtual-account/v2/payment-code';
        return PaycodeGeneratorVa::post($config, $params);
    }
}
