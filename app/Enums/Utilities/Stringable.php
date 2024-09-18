<?php

namespace App\Enums\Utilities;

use Illuminate\Support\Stringable as sting;

trait Stringable
{

    public function toString(): sting
    {
        return str($this->name);
    }

}
