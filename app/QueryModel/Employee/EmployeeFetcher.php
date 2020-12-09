<?php

declare(strict_types=1);

namespace App\QueryModel\Employee;

use App\QueryModel\BaseFetcher;
use App\QueryModel\User\ManagerView;
use Illuminate\Support\Facades\DB;

final class EmployeeFetcher extends BaseFetcher
{
    public function getAll()
    {
        $this->setCustomObjectMode(EmployeeView::class);

        $result = DB::table('employees')
            ->join('addresses', 'employees.id', '=', 'addresses.employee_id')
            ->select(
                'employees.id',
                'employees.name',
                'employees.email',
                'employees.phone',
                'employees.contract_date',
                'employees.contract_file',
                'addresses.id as address_id',
                'addresses.country',
                'addresses.city',
                'addresses.region',
                'addresses.street',
            )
            ->get();

        return $result;
    }

    public function getEmployeeForEdit(string $id)
    {
        $this->setCustomObjectMode(EmployeeView::class);

        $result = DB::table('employees')
            ->select('id', 'name', 'email', 'phone')
            ->where('id', '=', $id)
            ->get();

        return $result->first();
    }

    public function getEmployee($id)
    {
        $this->setCustomObjectMode(EmployeeView::class);

        $result = DB::table('employees')
            ->join('addresses', 'employees.id', '=', 'addresses.employee_id')
            ->select(
                'employees.id',
                'employees.name',
                'employees.email',
                'employees.phone',
                'employees.contract_date',
                'employees.contract_expiration',
                'employees.contract_file',
                'addresses.id as address_id',
                'addresses.country',
                'addresses.city',
                'addresses.region',
                'addresses.street',
                )
            ->where('employees.id', '=', $id)
            ->get();

        return $result->first();
    }

    public function getEmployeesByManager($id)
    {
        $this->setCustomObjectMode(EmployeeView::class);

        $result = DB::table('employees')
            ->join('employee_user', 'employees.id', '=', 'employee_user.employee_id')
            ->join('addresses', 'employees.id', '=', 'addresses.employee_id')
            ->select(
                'employees.id',
                'employees.name',
                'employees.email',
                'employees.phone',
                'employees.contract_date',
                'employees.contract_expiration',
                'employees.contract_file',
                'addresses.id as address_id',
                'addresses.country',
                'addresses.city',
                'addresses.region',
                'addresses.street',
                )
            ->where('employee_user.user_id', $id)
            ->get();

        return $result;
    }
}
