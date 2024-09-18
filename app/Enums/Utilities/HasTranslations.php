<?php

namespace App\Enums\Utilities;

trait HasTranslations
{
    abstract protected function getTranslatableKey(): string;
    /**
     * @return string
     */
    public function translated(): string
    {
        return trans($this->getTranslatableKey());
    }



}
