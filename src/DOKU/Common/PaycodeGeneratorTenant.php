<?php

namespace DOKU\Common;

use DOKU\Common\Config;

use DOKU\Common\Utils;

class PaycodeGeneratorTenant
{

    public static function post($config, $params)
    {
        $header = array();
        $data = array(
            "order" => array(
                "invoice_number" => $params['invoiceNumber'],
            ),
            "online_to_offline_info" => array(
                "expired_time" => $params['expiryTime'],
                "reusable_status" => $params['reusableStatus'],
                "info" => $params['info'] ?? $params['info1'],
            ),
            "customer" => array(
                "name" => trim($params['customerName']),
                "email" => $params['customerEmail']
            ),
            "additional_info" => array(
                "integration" => array(
                    "name" => "php-library",
                    "version" => "2.1.0"
                )
            )
        );

        if ($params['channel'] === 'alfa') {
            $data['alfa_info'] = array(
                "receipt" => array(
                    "footer_message" => $params['footerMessage'] ?? $params['info1'],
                )
            );
        } else if ($params['channel'] === 'indomaret') {
            $data['indomaret_info'] = array(
                "receipt" => array(
                    "description" => $params['footerDescription'] ?? $params['info1'],
                    "footer_message" => $params['footerMessage'] ?? $params['info2'],
                )
            );
        }

        if (isset($params['amount'])) {
            $data['order']["amount"] = $params['amount'];
        } else {
            $data['order']["min_amount"] = $params['min_amount'];
            $data['order']["max_amount"] = $params['min_amount'];
        }

        if (isset($params['additional_info'])) {
            foreach ($params['additional_info'] as $key => $value) {
                $data['additional_info'][$key] = $value;
            }
        }

        $requestId = rand(1, 100000);
        $dateTime = gmdate("Y-m-d H:i:s");
        $dateTime = date(DATE_ISO8601, strtotime($dateTime));
        $dateTimeFinal = substr($dateTime, 0, 19) . "Z";

        $getUrl = Config::getBaseUrl($config['environment']);

        $targetPath = $params['targetPath'];
        $url = $getUrl . $targetPath;

        $header['Client-Id'] = $config['client_id'];
        $header['Request-Id'] = $requestId;
        $header['Request-Timestamp'] = $dateTimeFinal;
        $signature = Utils::generateSignature($header, $targetPath, json_encode($data), $config['shared_key']);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Signature:' . $signature,
            'Request-Id:' . $requestId,
            'Client-Id:' . $config['client_id'],
            'Request-Timestamp:' . $dateTimeFinal,
            'Request-Target:' . $targetPath,

        ));

        $responseJson = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (is_string($responseJson) && $httpcode == 200) {
            return json_decode($responseJson, true);
        } else {
            echo $responseJson;
            return null;
        }
    }
}
