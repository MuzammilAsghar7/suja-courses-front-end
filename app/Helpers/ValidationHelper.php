<?php

namespace App\Helpers;

use Illuminate\Support\MessageBag;

class ValidationHelper
{
    public static function getValidationErrors(MessageBag $errors)
    {
        $errorArray = [];
        foreach ($errors->messages() as $field => $messages) {
            foreach ($messages as $message) {
                $errorArray[] = ['error' => $message];
            }
        }
        return $errorArray;
    }
}
