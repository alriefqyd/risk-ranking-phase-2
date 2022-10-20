<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class summernoteRequired implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($checkBox, $name)
    {
        $this->checkbox = $checkBox;
        $this->name = $name;
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
        if($this->checkbox && !strip_tags($value)) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->name . ' cannot be blank';
    }
}
