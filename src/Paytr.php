<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr;

use Gizemsever\LaravelPaytr\Direkt\BankIdentification;
use Gizemsever\LaravelPaytr\Direkt\Capi;
use Gizemsever\LaravelPaytr\Direkt\DPayment;
use Gizemsever\LaravelPaytr\Direkt\DPaymentVerification;
use Gizemsever\LaravelPaytr\Direkt\Installment;
use Gizemsever\LaravelPaytr\Payment\Basket;
use Gizemsever\LaravelPaytr\Payment\Payment;
use Gizemsever\LaravelPaytr\Payment\PaymentVerification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Paytr
{
    public function __construct(
        private readonly Client $client,
        private readonly array $credentials = [],
        private readonly array $options = []
    ) {
        //
    }

    public function createPayment(Payment $payment): PaytrResponse
    {
        return $payment->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options)
            ->create();
    }

    public function payment(): Payment
    {
        return new Payment;
    }

    public function direktPayment(): DPayment
    {
        return (new DPayment)
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }

    public function bin(): BankIdentification
    {
        return (new BankIdentification)
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }

    public function installments(): Installment
    {
        return (new Installment)
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }

    public function basket(): Basket
    {
        return new Basket;
    }

    public function direktPaymentVerification(Request $request): DPaymentVerification
    {
        return (new DPaymentVerification($request))
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }

    public function capi(): Capi
    {
        return (new Capi)
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }

    public function paymentVerification(Request $request): PaymentVerification
    {
        return (new PaymentVerification($request))
            ->setClient($this->client)
            ->setCredentials($this->credentials)
            ->setOptions($this->options);
    }
}
