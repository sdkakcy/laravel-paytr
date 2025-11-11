<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Direkt;

use Gizemsever\LaravelPaytr\PaytrClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DPaymentVerification extends PaytrClient
{
    private Request $request;

    private string $merchantOid;

    private string $status;

    private float $totalAmount;

    private string $hash;

    private ?int $failedReasonCode;

    private ?string $failedReasonMessage;

    private ?int $testMode;

    private ?string $paymentType;

    private ?string $currency;

    private ?int $paymentAmount;

    private ?string $uToken;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setup();
    }

    private function setup(): void
    {
        $this->merchantOid = $this->request->input('merchant_oid');
        $this->status = $this->request->input('status');
        $this->totalAmount = $this->request->input('total_amount');
        $this->hash = $this->request->input('hash');
        $this->failedReasonCode = $this->request->input('failed_reason_code', null);
        $this->failedReasonMessage = $this->request->input('failed_reason_message', null);
        $this->testMode = $this->request->input('test_mode', null);
        $this->paymentType = $this->request->input('payment_type');
        $this->currency = $this->request->input('currency');
        $this->paymentAmount = $this->request->input('payment_amount');
        $this->uToken = $this->request->input('utoken', null);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getMerchantOid(): string
    {
        return $this->merchantOid;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getFailedReasonCode(): ?int
    {
        return $this->failedReasonCode;
    }

    public function getFailedReasonMessage(): ?string
    {
        return $this->failedReasonMessage;
    }

    public function getTestMode(): ?int
    {
        return $this->testMode;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getPaymentAmount(): int
    {
        return $this->paymentAmount;
    }

    public function getUToken(): ?string
    {
        return $this->uToken;
    }

    private function generateHash(): string
    {
        return $this->getMerchantOid().
            $this->credentials['merchant_salt'].
            $this->getStatus().
            $this->getTotalAmount();
    }

    public function verifyRequest(): bool
    {
        $hash = $this->generateHash();
        $token = $this->generateToken($hash);

        return $token === $this->getHash();
    }

    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }

    public function getProcessedResponse(): Response
    {
        return response('OK', Response::HTTP_OK);
    }
}
