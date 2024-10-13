<?php

namespace App\Rules;

use App\Models\AttributeTranslation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueAttributeName implements ValidationRule
{
    private $attributeName;
    private $attributeId;

    public function __construct($attributeName, $attributeId)
    {
        $this->attributeName = $attributeName;
        $this->attributeId = $attributeId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this -> attributeId) //edit form
            $attributeItem = AttributeTranslation::where('name', $value)
                ->where('attribute_id','!=',$this->attributeId) -> first();
        else  //creation form
            $attributeItem = AttributeTranslation::where('name', $value)->first();

        if ($attributeItem) {
            $fail('this name already exists  before');
        }
    }
}
