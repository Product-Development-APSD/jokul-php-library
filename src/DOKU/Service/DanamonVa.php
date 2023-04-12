<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorVa;

class DanamonVa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/danamon-virtual-account/v2/payment-code';
        return PaycodeGeneratorVa::post($config, $params);
    }
}
