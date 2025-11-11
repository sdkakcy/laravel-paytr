<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Exceptions;

class InvalidConfigException extends PaytrException
{
    public static function configNotFound(): static
    {
        return new static('Setup your credentials to config.paytr');
    }
}
