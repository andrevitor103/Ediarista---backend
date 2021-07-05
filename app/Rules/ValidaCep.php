<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\ViaCep;

class ValidaCep implements Rule
{

    public ViaCep $viaCep;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(ViaCep $viaCep)
    {
        $this->viaCep = $viaCep;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cep = str_replace(['.', '-'], '', $value);
        return !! $this->viaCep->buscar($cep);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cep inválido';
    }
}
