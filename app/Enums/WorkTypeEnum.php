<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;

enum WorkTypeEnum: int
{
    use HasOperations,Stringable;
    case Onsite = 1;
    case Remotely = 2;

}
