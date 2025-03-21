<?php

declare (strict_types=1);

namespace App\Enum;

enum StatusEnum: string
{
    case PENDING = 'Pending';
    case VALIDATED = 'Dne';
    case DELETED = 'Deleted';
}