<?php

namespace App\Enums\Utilities;

use Illuminate\Support\Collection;

trait Collectable
{
    public function collect (): Collection
    {
        return collect(self::cases());
    }

}
