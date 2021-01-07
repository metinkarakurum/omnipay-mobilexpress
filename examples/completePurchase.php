<?php

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('Examples\\', __DIR__);

use Omnipay\MobilExpress\Gateway;
use Examples\Helper;

$gateway = new Gateway();
$helper = new Helper();

try {
    $params = $helper->getCompletePurchaseParams();
    $response = $gateway->completePurchase($params)->send();

    $result = [
        'status' => $response->isSuccessful() ?: 0,
        'bankTransId' => $response->getTransactionReference(),
        'mobileExpressTransId' => $response->getMobilExpressTransId(),
        'message' => $response->getMessage(),
        'requestParams' => $response->getServiceRequestParams(),
        'response' => $response->getData()
    ];

    print("<pre>" . print_r($result, true) . "</pre>");
} catch (Exception $e) {
    throw new \RuntimeException($e->getMessage());
}
