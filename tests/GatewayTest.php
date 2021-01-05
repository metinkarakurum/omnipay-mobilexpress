<?php

namespace OmnipayTest\MobilExpress;

use Omnipay\Common\CreditCard;
use Omnipay\MobilExpress\Gateway;
use Omnipay\MobilExpress\Messages\PurchaseResponse;
use Omnipay\Tests\GatewayTestCase;


class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    public $gateway;

    /** @var array */
    public $options;

    public function setUp()
    {
        /** @var Gateway gateway */
        $this->gateway = new Gateway(null, $this->getHttpRequest());
        $this->gateway->setMerchantId('xxxx');
        $this->gateway->setTestMode(true);
        $this->gateway->setPassword('xxxx');
        $this->gateway->setPosId('xxxx');
    }

    public function testPurchase()
    {
        $this->options = [
            'card' => $this->getCardInfo(),
            'orderId' => uniqid(),
            'amount' => '500',
            'returnUrl' => "https://localhost",
            'installment' => 0,
            'paymentMethod' => '',
            'clientIp' => '129.168.2.1'
        ];

        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }


    /**
     * @return CreditCard
     */
    private function getCardInfo(): CreditCard
    {
        $cardInfo = $this->getValidCard();
        $cardInfo['number'] = '4022774022774026';
        $cardInfo['expiryMonth'] = 12;
        $cardInfo['expiryYear'] = 2022;
        $cardInfo['cvv'] = '000';
        $card = new CreditCard($cardInfo);

        return $card;
    }
}