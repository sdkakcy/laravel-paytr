<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Payment;

use Gizemsever\LaravelPaytr\PaytrClient;
use Gizemsever\LaravelPaytr\PaytrResponse;

class Payment extends PaytrClient
{
    private string $userIp;

    private string $merchantOid;

    private string $email;

    private float $paymentAmount;

    private int $noInstallment;

    private int $maxInstallment;

    private string $userName;

    private string $userAddress;

    private string $userPhone;

    private string $successUrl;

    private string $failUrl;

    private bool $debugOn = false;

    private Basket $basket;

    private string $currency = Currency::TRY;

    private int $timeoutLimit = 0;

    private string $lang = 'tr';

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getUserIp(): string
    {
        return $this->userIp;
    }

    public function setUserIp(string $userIp): static
    {
        $this->userIp = $userIp;

        return $this;
    }

    public function getMerchantOid(): string
    {
        return $this->merchantOid;
    }

    public function setMerchantOid(string $merchantOid): static
    {
        $this->merchantOid = $merchantOid;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(float $paymentAmount): static
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    public function getNoInstallment(): int
    {
        return $this->noInstallment;
    }

    public function setNoInstallment(int $noInstallment): static
    {
        $this->noInstallment = $noInstallment;

        return $this;
    }

    public function getMaxInstallment(): int
    {
        return $this->maxInstallment;
    }

    public function setMaxInstallment(int $maxInstallment): static
    {
        $this->maxInstallment = $maxInstallment;

        return $this;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserAddress(): string
    {
        return $this->userAddress;
    }

    public function setUserAddress(string $userAddress): static
    {
        $this->userAddress = $userAddress;

        return $this;
    }

    public function getUserPhone(): string
    {
        return $this->userPhone;
    }

    public function setUserPhone(string $userPhone): static
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function setSuccessUrl(string $successUrl): static
    {
        $this->successUrl = $successUrl;

        return $this;
    }

    public function getFailUrl(): string
    {
        return $this->failUrl;
    }

    public function setFailUrl(string $failUrl): static
    {
        $this->failUrl = $failUrl;

        return $this;
    }

    public function isDebugOn(): bool
    {
        return $this->debugOn;
    }

    public function setDebugOn(bool $debugOn): static
    {
        $this->debugOn = $debugOn;

        return $this;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }

    public function setBasket(Basket $basket): static
    {
        $this->basket = $basket;

        return $this;
    }

    public function getTimeoutLimit(): int
    {
        return $this->timeoutLimit;
    }

    public function setTimeoutLimit(int $timeoutLimit): static
    {
        $this->timeoutLimit = $timeoutLimit;

        return $this;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    private function getHash(): string
    {
        return ''.
            $this->credentials['merchant_id'].
            $this->getUserIp().
            $this->getMerchantOid().
            $this->getEmail().
            $this->formattedPaymentAmount().
            $this->basket->formatted().
            $this->getNoInstallment().
            $this->getMaxInstallment().
            $this->getCurrency().
            $this->options['test_mode'];
    }

    private function createPaymentToken(): string
    {
        $hash = $this->getHash();

        return base64_encode(hash_hmac('sha256', $hash.$this->credentials['merchant_salt'], $this->credentials['merchant_key'], true));
    }

    private function formattedPaymentAmount(): float
    {
        return $this->getPaymentAmount() * 100;
    }

    private function getBody(): array
    {
        $paymentToken = $this->createPaymentToken();

        return [
            'merchant_id' => $this->credentials['merchant_id'],
            'user_ip' => $this->getUserIp(),
            'merchant_oid' => $this->getMerchantOid(),
            'email' => $this->getEmail(),
            'payment_amount' => $this->formattedPaymentAmount(),
            'currency' => $this->getCurrency(),
            'user_basket' => $this->basket->formatted(),
            'no_installment' => $this->getNoInstallment(),
            'max_installment' => $this->getMaxInstallment(),
            'paytr_token' => $paymentToken,
            'user_name' => $this->getUserName(),
            'user_address' => $this->getUserAddress(),
            'user_phone' => $this->getUserPhone(),
            'merchant_ok_url' => $this->options['success_url'],
            'merchant_fail_url' => $this->options['fail_url'],
            'test_mode' => $this->options['test_mode'],
            'debug_on' => $this->isDebugOn(),
            'timeout_limit' => $this->getTimeoutLimit(),
            'lang' => $this->getLang(),
        ];
    }

    public function create(): PaytrResponse
    {
        $requestBody = $this->getBody();
        $response = $this->callApi('POST', 'odeme/api/get-token', $requestBody);

        return new PaytrResponse(json_decode((string) $response->getBody(), true));
    }
}
