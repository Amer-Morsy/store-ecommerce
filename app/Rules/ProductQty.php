<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductQty implements ValidationRule
{
    private $manage_stock;

    /**
     * Create a new rule instance.
     *
     * @param  mixed  $manage_stock
     */
    public function __construct($manage_stock)
    {
        $this->manage_stock = $manage_stock;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->manage_stock == 1 && $value === null) {
            $fail('The qty must have value when manage stock equals 1.');
        }
    }
}
