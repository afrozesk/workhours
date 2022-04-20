<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeWorkHoursModel.
 *
 * @property int employee_id
 * @property string date
 * @property string start_hour
 * @property string end_hour
 */
class EmployeeWorkHoursModel extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'employee_workhours';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'employee_id',
        'date',
        'start_hour',
        'end_hour',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'date' => 'string',
        'start_hour' => 'string',
        'end_hour' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @return array
     */
    public static function validationRules(): array
    {
        return [
            'employee_id' => 'required|int',
            'date' => 'required|date_format:Y-m-d',
            'start_hour' => 'required|numeric',
            'end_hour' => 'required|numeric|after:time_start',
        ];
    }

    /**
     * Check if shift hours are valid.
     *
     * @param int $start
     * @param int $end
     *
     * @return bool
     */
    public static function isValidShift(int $start, int $end): bool
    {
        return ($start === 0 && $end === 8)
            || ($start === 8 && $end === 16)
            || ($start === 16 && $end === 24);
    }
}
