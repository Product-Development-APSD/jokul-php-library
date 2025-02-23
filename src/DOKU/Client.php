<?php

namespace DOKU;

use DOKU\Service\VirtualAccount;

use DOKU\Service\MandiriVa;

use DOKU\Service\DokuVa;

use DOKU\Service\BcaVa;

use DOKU\Service\BniVa;

use DOKU\Service\BsiVa;

use DOKU\Service\BriVa;

use DOKU\Service\CimbVa;

use DOKU\Service\PermataVa;

use DOKU\Service\DanamonVa;

use DOKU\Service\CreditCard;

use DOKU\Service\DokuWallet;

use DOKU\Service\Ovo;

use DOKU\Service\ShopeePay;

use DOKU\Service\Alfa;

use DOKU\Service\Indomaret;

class Client
{
    /**
     * @var array
     */
    private $config = array();

    public function isProduction($value)
    {
        $this->config['environment'] = $value;
    }

    public function setClientID($clientID)
    {
        $this->config['client_id'] = $clientID;
    }

    public function setSharedKey($key)
    {
        $this->config['shared_key'] = $key;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function generateMandiriVa($params)
    {
        $this->config = $this->getConfig();
        return MandiriVa::generated($this->config, $params);
    }

    public function generateDokuVa($params)
    {
        $this->config = $this->getConfig();
        return DokuVa::generated($this->config, $params);
    }

    public function generateBsiVa($params)
    {
        $this->config = $this->getConfig();
        return BsiVa::generated($this->config, $params);
    }

    public function generateBcaVa($params)
    {
        $this->config = $this->getConfig();
        return BcaVa::generated($this->config, $params);
    }

    public function generateBriVa($params)
    {
        $this->config = $this->getConfig();
        return BriVa::generated($this->config, $params);
    }

    public function generateBniVa($params)
    {
        $this->config = $this->getConfig();
        return BniVa::generated($this->config, $params);
    }

    public function generatePermataVa($params)
    {
        $this->config = $this->getConfig();
        return PermataVa::generated($this->config, $params);
    }

    public function generateDanamonVa($params)
    {
        $this->config = $this->getConfig();
        return DanamonVa::generated($this->config, $params);
    }

    public function generateCimbVa($params)
    {
        $this->config = $this->getConfig();
        return CimbVa::generated($this->config, $params);
    }

    public function generateCreditCard($params)
    {
        $this->config = $this->getConfig();
        return CreditCard::generated($this->config, $params);
    }

    public function generateDokuWallet($params)
    {
        $this->config = $this->getConfig();
        return DokuWallet::generated($this->config, $params);
    }

    public function generateShopeePay($params)
    {
        $this->config = $this->getConfig();
        return ShopeePay::generated($this->config, $params);
    }

    public function generateOvo($params)
    {
        $this->config = $this->getConfig();
        return Ovo::generated($this->config, $params);
    }

    public function generateAlfa($params)
    {
        $this->config = $this->getConfig();
        return Alfa::generated($this->config, $params);
    }

    public function generateIndomaret($params)
    {
        $this->config = $this->getConfig();
        return Indomaret::generated($this->config, $params);
    }
}
