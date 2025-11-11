<?php

/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace Gizemsever\LaravelPaytr\Payment;

enum Currency: string
{
    case TRY = 'TRY';
    case EUR = 'EUR';
    case USD = 'USD';
    case GBP = 'GBP';
    case RUB = 'RUB';
}
