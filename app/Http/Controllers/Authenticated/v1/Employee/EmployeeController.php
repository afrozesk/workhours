<?php

namespace App\Http\Controllers\Authenticated\v1\Employee;

use App\Http\Controllers\Authenticated\v1\Controller as BaseController;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class EmployeeController.
 */
class EmployeeController extends BaseController
{
    /**
     * Add employee.
     *
     * @param Request $request
     * @param Response $response
     *
     * @throws ValidationException
     *
     * @return Response
     */
    public function insert(Request $request, Response $response): Response
    {
        $this->validate($request, EmployeeModel::validationRules());

        /** @var EmployeeModel $employee */
        $employee = EmployeeModel::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return $response
            ->setStatusCode(Response::HTTP_CREATED)
            ->setContent($employee->toJson());
    }
}
