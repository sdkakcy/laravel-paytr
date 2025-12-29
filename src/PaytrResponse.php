<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr;

class PaytrResponse
{
    public function __construct(private readonly ?array $content)
    {
        //
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function getStatus(): ?string
    {
        return $this->content['status'] ?? null;
    }

    public function isSuccess(): bool
    {
        return $this->getStatus() === 'success';
    }

    public function getMessage(): ?string
    {
        return $this->content['reason'] ?? null;
    }

    public function getToken(): ?string
    {
        return $this->content['token'] ?? null;
    }
}
