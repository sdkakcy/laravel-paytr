<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr;

class PaytrResponse
{
    public function __construct(private readonly ?array $response)
    {
        //
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }

    public function getStatus(): ?string
    {
        return $this->response['status'] ?? null;
    }

    public function isSuccess(): bool
    {
        return $this->getStatus() === 'success';
    }

    public function getMessage(): ?string
    {
        return $this->response['reason'] ?? null;
    }

    public function getToken(): ?string
    {
        return $this->response['token'] ?? null;
    }
}
