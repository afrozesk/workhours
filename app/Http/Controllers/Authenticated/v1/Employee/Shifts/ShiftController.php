<?php

namespace App\Http\Controllers\Authenticated\v1\Employee\Shifts;

use App\Http\Controllers\Authenticated\v1\Controller;
use App\Models\EmployeeModel;
use App\Models\EmployeeWorkHoursModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ShiftController.
 */
class ShiftController extends Controller
{
    /**
     * Add employee shift.
     *
     * @param int $employeeId
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function insert(Request $request, Response $response, int $employeeId): Response
    {
        /** @var EmployeeModel $employee */
        $employee = EmployeeModel::findOrFail($employeeId);

        /** @var EmployeeWorkHoursModel $shift */
        $shift = $employee->addShift($request);

        return $response->setContent(Response::HTTP_CREATED)
                        ->setContent($shift->toJson());
    }

    /**
     * List employee shifts.
     *
     * @param int $employeeId
     * @param Response $response
     *
     * @return Response
     */
    public function list(int $employeeId, Response $response): Response
    {
        /** @var EmployeeModel $employee */
        $employee = EmployeeModel::findOrFail($employeeId);

        return $response->setContent(Response::HTTP_OK)
                        ->setContent($employee->shifts()->get()->toJson());
    }

}
