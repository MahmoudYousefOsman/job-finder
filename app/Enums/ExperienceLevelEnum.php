<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;

enum ExperienceLevelEnum: int
{
    use HasOperations,Stringable;
    case Entry = 1;
    case junior = 2;
    case senior = 3;
    case TeamLeader = 4;
    case TechLeader = 5;
}
