<?php

namespace App\Enums\Utilities;

trait HasOperations
{

    /**
     * @param HasOperations $enum
     * @return bool
     */
    public function is(self $enum): bool
    {
        return $enum === $this;
    }

    public function isNot(self $enum): bool
    {
        return ! $this->is($enum);
    }


}
