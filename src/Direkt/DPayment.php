<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Direkt;

use Gizemsever\LaravelPaytr\Payment\Basket;
use Gizemsever\LaravelPaytr\PaytrClient;
use Gizemsever\LaravelPaytr\PaytrResponse;
use Psr\Http\Message\StreamInterface;

class DPayment extends PaytrClient
{
    private ?string $userIp;

    private ?string $merchantOid;

    private ?string $email;

    private float|string|null $paymentAmount;

    private ?string $paymentType = 'card';

    private ?string $cardType;

    private ?int $installmentCount = 0;

    private ?string $currency = 'TL';

    private ?int $non3d = 0;

    private ?int $non3dTestFailed = 0;

    private ?string $clientLang = 'tr';

    private ?string $ccOwner;

    private ?string $cardNumber;

    /**
     * @example 1, 2, 3, .. , 11, 12
     */
    private ?string $expiryMonth;

    /**
     * @example 20, 21, 22,…
     */
    private ?string $expiryYear;

    private ?string $cvv;

    private ?string $successUrl;

    private ?string $failUrl;

    private ?string $userName;

    private ?string $userAddress;

    private ?string $userPhone;

    private ?Basket $basket;

    private ?int $debugOn = 1;

    private ?int $syncMode = 0;

    private ?string $uToken;

    private ?int $storeCard = 0;

    private ?string $cToken;

    private ?int $recurringPayment;

    public function getUserIp(): ?string
    {
        return $this->userIp;
    }

    public function setUserIp(?string $userIp): static
    {
        $this->userIp = $userIp;

        return $this;
    }

    public function getMerchantOid(): ?string
    {
        return $this->merchantOid;
    }

    public function setMerchantOid(?string $merchantOid): static
    {
        $this->merchantOid = $merchantOid;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPaymentAmount(): float|string|null
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(float|string|null $paymentAmount): static
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(?string $paymentType): static
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getCardType(): ?string
    {
        return $this->cardType;
    }

    public function setCardType(?string $cardType): static
    {
        $this->cardType = $cardType;

        return $this;
    }

    public function getInstallmentCount(): ?int
    {
        return $this->installmentCount;
    }

    public function setInstallmentCount(?int $installmentCount): static
    {
        $this->installmentCount = $installmentCount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getNon3d(): ?int
    {
        return $this->non3d;
    }

    public function setNon3d(?int $non3d): static
    {
        $this->non3d = $non3d;

        return $this;
    }

    public function getNon3dTestFailed(): ?int
    {
        return $this->non3dTestFailed;
    }

    public function setNon3dTestFailed(?int $non3dTestFailed): static
    {
        $this->non3dTestFailed = $non3dTestFailed;

        return $this;
    }

    public function getClientLang(): ?string
    {
        return $this->clientLang;
    }

    public function setClientLang(?string $clientLang): static
    {
        $this->clientLang = $clientLang;

        return $this;
    }

    public function getCcOwner(): ?string
    {
        return $this->ccOwner;
    }

    public function setCcOwner(?string $ccOwner): static
    {
        $this->ccOwner = $ccOwner;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(?string $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getExpiryMonth(): ?string
    {
        return $this->expiryMonth;
    }

    public function setExpiryMonth(?string $expiryMonth): static
    {
        $this->expiryMonth = $expiryMonth;

        return $this;
    }

    public function getExpiryYear(): ?string
    {
        return $this->expiryYear;
    }

    public function setExpiryYear(?string $expiryYear): static
    {
        $this->expiryYear = $expiryYear;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(?string $cvv): static
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserAddress(): ?string
    {
        return $this->userAddress;
    }

    public function setUserAddress(?string $userAddress): static
    {
        $this->userAddress = $userAddress;

        return $this;
    }

    public function getUserPhone(): ?string
    {
        return $this->userPhone;
    }

    public function setUserPhone(?string $userPhone): static
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): static
    {
        $this->basket = $basket;

        return $this;
    }

    public function getDebugOn(): ?int
    {
        return $this->debugOn;
    }

    public function setDebugOn(?int $debugOn): static
    {
        $this->debugOn = $debugOn;

        return $this;
    }

    public function getSyncMode(): ?int
    {
        return $this->syncMode;
    }

    public function setSyncMode(?int $syncMode): static
    {
        $this->syncMode = $syncMode;

        return $this;
    }

    public function getUToken(): ?string
    {
        return $this->uToken;
    }

    public function setUToken(?string $uToken): static
    {
        $this->uToken = $uToken;

        return $this;
    }

    public function getStoreCard(): ?int
    {
        return $this->storeCard;
    }

    public function setStoreCard(?int $storeCard): static
    {
        $this->storeCard = $storeCard;

        return $this;
    }

    public function getCToken(): ?string
    {
        return $this->cToken;
    }

    public function setCToken(?string $cToken): static
    {
        $this->cToken = $cToken;

        return $this;
    }

    public function getRecurringPayment(): ?int
    {
        return $this->recurringPayment;
    }

    public function setRecurringPayment(?int $recurringPayment): static
    {
        $this->recurringPayment = $recurringPayment;

        return $this;
    }

    private function getHash(): string
    {
        return ''.
            $this->credentials['merchant_id'].
            $this->getUserIp().
            $this->getMerchantOid().
            $this->getEmail().
            $this->getPaymentAmount().
            $this->getPaymentType().
            $this->getInstallmentCount().
            $this->getCurrency().
            (int) $this->options['test_mode'].
            $this->getNon3d().
            $this->credentials['merchant_salt'];
    }

    public function setSuccessUrl(string $url): static
    {
        $this->options['success_url'] = $url;

        return $this;
    }

    public function setFailUrl(string $url): static
    {
        $this->options['fail_url'] = $url;

        return $this;
    }

    public function createRecurringPayment(): PaytrResponse
    {
        $hash = $this->getHash();
        $token = $this->generateToken($hash);

        $body = [
            'merchant_id' => $this->credentials['merchant_id'],
            'paytr_token' => $token,
            'user_ip' => $this->getUserIp(),
            'merchant_oid' => $this->getMerchantOid(),
            'email' => $this->getEmail(),
            'payment_type' => $this->getPaymentType(),
            'payment_amount' => $this->getPaymentAmount(),
            'installment_count' => $this->getInstallmentCount(),
            'currency' => $this->getCurrency(),
            'test_mode' => (int) $this->options['test_mode'],
            'non_3d' => $this->getNon3d(),
            'non3d_test_failed' => $this->getNon3dTestFailed(),
            'merchant_ok_url' => $this->options['success_url'],
            'merchant_fail_url' => $this->options['fail_url'],
            'user_name' => $this->getUserName(),
            'user_address' => $this->getUserAddress(),
            'user_phone' => $this->getUserPhone(),
            'user_basket' => $this->getBasket()->formatted(),
            'debug_on' => $this->getDebugOn(),
            'utoken' => $this->getUToken(),
            'ctoken' => $this->getCToken(),
            'recurring_payment' => $this->getRecurringPayment(),
        ];

        $response = $this->callApi('POST', 'odeme', $body);

        return new PaytrResponse(json_decode((string) $response->getBody(), true));
    }

    public function getBody(): array
    {
        $hash = $this->getHash();
        $token = $this->generateToken($hash);

        return [
            'merchant_id' => $this->credentials['merchant_id'],
            'paytr_token' => $token,
            'user_ip' => $this->getUserIp(),
            'merchant_oid' => $this->getMerchantOid(),
            'email' => $this->getEmail(),
            'payment_type' => $this->getPaymentType(),
            'payment_amount' => $this->getPaymentAmount(),
            'installment_count' => $this->getInstallmentCount(),
            'card_type' => $this->getCardType(),
            'currency' => $this->getCurrency(),
            'client_lang' => $this->getClientLang(),
            'test_mode' => (int) $this->options['test_mode'],
            'non_3d' => $this->getNon3d(),
            'non3d_test_failed' => $this->getNon3dTestFailed(),
            'merchant_ok_url' => $this->options['success_url'],
            'merchant_fail_url' => $this->options['fail_url'],
            'user_name' => $this->getUserName(),
            'user_address' => $this->getUserAddress(),
            'user_phone' => $this->getUserPhone(),
            'user_basket' => $this->getBasket()->formatted(),
            'debug_on' => $this->getDebugOn(),
            'sync_mode' => $this->getSyncMode(),
            'store_card' => $this->getStoreCard(),
        ];
    }

    public function create(): StreamInterface
    {
        $body = $this->getBody();

        $body['cc_owner'] = $this->getCcOwner();
        $body['card_number'] = $this->getCardNumber();
        $body['expiry_month'] = $this->getExpiryMonth();
        $body['expiry_year'] = $this->getExpiryYear();
        $body['cvv'] = $this->getCvv();

        $response = $this->callApi('POST', 'odeme', $body);

        return $response->getBody();
    }
}
