<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeListResource;
use App\Http\Resources\ManagerListResource;
use App\QueryModel\Employee\EmployeeFetcher;
use App\QueryModel\User\UserFetcher;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    private UserFetcher $userFetcher;
    private EmployeeFetcher $employeeFetcher;

    public function __construct(UserFetcher $userFetcher, EmployeeFetcher $employeeFetcher)
    {
        $this->userFetcher = $userFetcher;
        $this->employeeFetcher = $employeeFetcher;
    }

    public function managers()
    {
        $managers = $this->userFetcher->getAllManagers();
        return ManagerListResource::collection($managers);
    }

    public function employeesByManager($id)
    {
        $employees = $this->employeeFetcher->getEmployeesByManager($id);
        return EmployeeListResource::collection($employees);
    }

    public function employees(Request $request)
    {
        $employees = $this->employeeFetcher->getEmployeesByManager($request->user()->id);
        return EmployeeListResource::collection($employees);
    }
}
