<?php

namespace Controllers;

class OrdersController
{
    protected $ci;

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    public function Store($req)
    {
        // requests via front-end
    $method = $req->get('method');
        $items = $req->get('items');
        $hash = $req->get('hash');
        $total = $req->get('total');
        $token = $req->get('token');
    //PagSeguro Configs
    $directPaymentRequest = new PagSeguroDirectPaymentRequest();
        $directpaymentRequest->setPaymentMode('DEFAULT'); // GATEWAY
    $directpaymentRequest->setPaymentMethod($method);
        $directpaymentRequest->setCurrency('BRL');

    // Add Itens
    foreach ($items as $key => $item) {
        $directPaymentRequest->addItem("00$key", $item['name'], 1, $item['price']);
    }

    // Set Sender
    $directpaymentRequest->setSender(
        'João Comprador',
        'email@comprador.com.br',
        '11',
        '56273440',
        'CPF',
        '156.009.442-76'
      );

      // get hash via front-end
      $directPaymentRequest->setSenderHash($hash);

      // get total via front-end
      $installments = new PagSeguroInstallment(
        [
          'quantity' => '1',
          'value'    => $total,
        ]
      );

      // Shipping type **Optional**
      $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');
        $directpaymentRequest->setShippingType($sedexCode);
        $directPaymentRequest->setShippingAddress(
        '01452002',
        'Av. Brig. Faria Lima',
        '1384',
        'apto. 114',
        'Jardim Paulistano',
        'São Paulo',
        'SP',
        'BRA'
      );

      // Billing information
      $billingAddress = new PagSeguroBilling(
          [
            'postalCode' => '01452002',
            'street'     => 'Av. Brig. Faria Lima',
            'number'     => '1384',
            'complement' => 'apto. 114',
            'district'   => 'Jardim Paulistano',
            'city'       => 'São Paulo',
            'state'      => 'SP',
            'country'    => 'BRA',
          ]
      );

      // Set payment method
      $creditCardData = new PagSeguroCreditCardCheckout(
        [
          'token'       => $token,
          'installment' => $installments,
          'billing'     => $billingAddress,
          'holder'      => new PagSeguroCreditCardHolder(
            [
              'name'      => 'João Comprador',
              'birthDate' => date('01/10/1979'),
              'areaCode'  => '11',
              'number'    => '56273440',
              'documents' => [
                'type'  => 'CPF',
                'value' => '156.009.442-76',
              ],
            ]
          ),
        ]
      );

        $directpaymentRequest->setCreditCard($creditCardData);

        try {
            $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
        $response = $directpaymentRequest->register($credentials);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }
}
