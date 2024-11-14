<?php

namespace App\Rules;

use App\Models\AttributeTranslation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductQty implements ValidationRule
{
    private $attributeName;
    private $attributeId;

    /**
     * Create a new rule instance.
     *
     * @param  mixed  $manage_stock
     */
    public function __construct($attributeName, $attributeId)
    {
        $this->attributeName = $attributeName;
        $this->attributeId = $attributeId;
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
        if($this -> attributeId) //edit form
            $attribute = AttributeTranslation::where('name', $value)->where('attribute_id','!=',$this->attributeId) -> first();
        else  //creation form
            $attribute = AttributeTranslation::where('name', $value)->first();
        if ($attribute) {
            $fail('this name already exists  before');
        }
    }
}
