<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LoginAuthentication implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $password;
    public function __construct($password)
    {
        $this->password = $password;
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
        if(auth()->attempt(['email' => $value, 'password' => $this->password])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email or password seems wrong';
    }
}
