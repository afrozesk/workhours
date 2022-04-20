<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

/**
 * Class EmployeeModel.
 */
class EmployeeModel extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'employee';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Validation rules.
     *
     * @return array
     */
    public static function validationRules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
        ];
    }

    /**
     * Get employee shifts.
     *
     * @param Carbon|null $date
     *
     * @return HasMany
     */
    public function shifts(?Carbon $date = null): HasMany
    {
        return $this->hasMany(EmployeeWorkHoursModel::class, 'employee_id')
                    ->where(function (Builder $query) use ($date): void {
                        if ($date) {
                            $query->where('date', '=', $date->toDateString());
                        }
                    });
    }

    /**
     * Add shift for employee.
     *
     * @param Request $request
     *
     * @return EmployeeWorkHoursModel
     */
    public function addShift(Request $request): EmployeeWorkHoursModel
    {
        /** @var Carbon $date */
        $date = Carbon::parse($request->get('date'));

        /** @var string $startHour */
        $startHour = $request->get('start_hour');

        /** @var string $endHour */
        $endHour = $request->get('end_hour');

        if (!$date->isValid() || $date->isPast()) {
            throw new Exception('Can\'t add shift for past dates.');
        }

        if (!EmployeeWorkHoursModel::isValidShift($startHour, $endHour)) {
            throw new Exception('Unacceptable shift');
        }

        // Check if employee has the shift on that day
        if ($this->shifts($date)->first()) {
            throw new Exception('Employee has shift on provided day, can\'t add second shift.');
        }

        /** @var array $shiftValues */
        $shiftValues = [
            'employee_id' => $this->id,
            'date' => $date->toDateString(),
            'start_hour' => $startHour,
            'end_hour' => $endHour,
        ];

        Validator::validate($shiftValues, EmployeeWorkHoursModel::validationRules());

        return EmployeeWorkHoursModel::create($shiftValues);
    }
}
