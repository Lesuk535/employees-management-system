<?php

declare(strict_types=1);

namespace App\Models\Employee\Services;

use App\Http\Requests\Employee\CreateRequest;
use App\Models\Employee\Entity\Email;
use App\Models\Employee\Entity\Employee;
use App\Models\Employee\Entity\Name;
use App\Models\Employee\Entity\Phone;
use App\Models\User\Entity\User;
use Carbon\Carbon;
use DB;

final class CreateEmployeeService
{
    public function create(CreateRequest $request, ContractUploadService $contractUpload): void
    {
        $request['managers'] = User::where('role', 'manager')
            ->whereIn('id', $request['managers'])
            ->pluck('id')
            ->toArray();

        if (!$request['managers']) {
            throw new \DomainException('A manager must be assigned to the employee');
        }

        $employee = DB::transaction(function() use ($request)
        {
            /** @var Employee $employee */
            $employee = Employee::new(
                new Name($request['name']),
                new Email($request['email']),
                new Phone($request['phone']),
                Carbon::createFromFormat('Y-m-d', $request['contract_date']),
                Carbon::createFromFormat('Y-m-d', $request['contract_expiration']),
            );

            $employee->createAddress(
                $request['country'],
                $request['city'],
                $request['region'],
                $request['street']
            );

            $employee->attachManager($request['managers']);
            return $employee;
        });

        $fileName = $contractUpload->upload($request->file('file'), $employee->getContractPath());
        $employee->uploadContract($fileName);

    }
}
