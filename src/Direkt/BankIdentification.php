<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Direkt;

use Gizemsever\LaravelPaytr\PaytrClient;
use Gizemsever\LaravelPaytr\PaytrResponse;

class BankIdentification extends PaytrClient
{
    private ?string $binNumber;

    public function getBinNumber(): ?string
    {
        return $this->binNumber;
    }

    public function setBinNumber(?string $binNumber): static
    {
        $this->binNumber = $binNumber;

        return $this;
    }

    private function getHash(): string
    {
        return ''.
            $this->getBinNumber().
            $this->credentials['merchant_id'].
            $this->credentials['merchant_salt'];
    }

    public function checkBin(): PaytrResponse
    {
        $hash = $this->getHash();
        $token = $this->generateToken($hash);
        $body = [
            'merchant_id' => $this->credentials['merchant_id'],
            'bin_number' => $this->getBinNumber(),
            'paytr_token' => $token,
        ];

        $response = $this->callApi('POST', 'odeme/api/bin-detail', $body);

        return new PaytrResponse(json_decode((string) $response->getBody(), true));
    }
}
