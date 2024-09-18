<?php

namespace App\Enums;

use App\Enums\Utilities\HasOperations;
use App\Enums\Utilities\Stringable;

enum ApplicationStatusEnum: int
{
    use HasOperations,Stringable;
    case Pending = 1;
    case Accepted = 2;
    case Cancel = 3;
    case CancelByEmployee = 4;
    public function toBadge(): string
    {

        return match ($this) {
            ApplicationStatusEnum::Pending => "<span class='badge badge-pill badge-primary'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Accepted => "<span class='badge badge-pill badge-success'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Cancel, ApplicationStatusEnum::CancelByEmployee => "<span class='badge badge-pill badge-danger'>{$this->toString()->ucsplit()->implode(' ')}</span>",
        };
    }

    public function toBadgeTailwind(): string
    {

        return match ($this) {
            ApplicationStatusEnum::Pending => "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Accepted => "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>{$this->toString()->ucsplit()->implode(' ')}</span>",
            ApplicationStatusEnum::Cancel, ApplicationStatusEnum::CancelByEmployee => "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'>{$this->toString()->ucsplit()->implode(' ')}</span>",
        };
    }
}
