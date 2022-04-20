<?php

namespace App\Entities\Date;

use Illuminate\Support\Facades\Validator;

/**
 * Class Date.
 */
class Date
{
    /**
     * Check if date is valid.
     *
     * @param string $date
     *
     * @return void
     */
    public static function isValid(string $date): void
    {
        Validator::validate(
            ['date' => $date],
            ['date' => 'date_format:Y-m-d']
        );
    }
}
