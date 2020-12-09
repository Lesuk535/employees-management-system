<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\ChangeManagersRequest;
use App\Http\Requests\Employee\EditAddressRequest;
use App\Http\Requests\Employee\EditContractRequest;
use App\Http\Requests\Employee\EditEmployeeRequest;
use App\Http\Requests\Employee\CreateRequest;
use App\Models\Employee\Entity\Email;
use App\Models\Employee\Entity\Employee;
use App\Models\Employee\Entity\Name;
use App\Models\Employee\Entity\Phone;
use App\Models\Employee\Services\ContractUploadService;
use App\Models\Employee\Services\CreateEmployeeService;
use App\Models\User\Entity\User;
use App\QueryModel\Employee\EmployeeFetcher;
use App\QueryModel\User\UserFetcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private CreateEmployeeService $createEmployeeService;
    private ContractUploadService $contractUpload;
    private UserFetcher $userFetcher;
    private EmployeeFetcher $employeeFetcher;

    public function __construct(
        CreateEmployeeService $createEmployeeService,
        ContractUploadService $contractUpload,
        UserFetcher $userFetcher,
        EmployeeFetcher $employeeFetcher
    ) {
        $this->middleware('can:admin');
        $this->createEmployeeService = $createEmployeeService;
        $this->contractUpload = $contractUpload;
        $this->userFetcher = $userFetcher;
        $this->employeeFetcher = $employeeFetcher;
    }

    public function index(EmployeeFetcher $employeeFetcher)
    {
        $employees = $this->employeeFetcher->getAll();
        return view('admin.employee.index', compact('employees'));
    }

    public function showCreateForm()
    {
        $managers = $this->userFetcher->getActiveManagers();
        return view('admin.employee.create-employee', compact('managers'));
    }

    public function create(CreateRequest $request, ContractUploadService $contractUpload)
    {
        try {
            $this->createEmployeeService->create($request, $contractUpload);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('create-employee-form')->with('success', 'Employee successfully created');
    }

    public function showEditEmployeeForm($id)
    {
        $employee = $this->employeeFetcher->getEmployeeForEdit($id);
        return view('admin.employee.edit-employee', compact('employee'));
    }

    public function editEmployee(EditEmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $employee->editEmployee(
                new Name($request['name']),
                new Email($request['email']),
                new Phone($request['phone'])
            );
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('edit-employee-form', ['id' => $id])->with('success', 'Employee successfully edited');
    }

    public function showEditAddressForm($id)
    {
        $employee = $this->employeeFetcher->getEmployee($id);
        return view('admin.employee.edit-address', compact('employee'));
    }

    public function editAddress(EditAddressRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $employee->editAddress(
                $request['country'],
                $request['city'],
                $request['region'],
                $request['street']
            );
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
        return redirect()->route('edit-employee-address-form', ['id' => $id])->with('success', 'Address successfully edited');
    }

    public function showEditContract($id)
    {
        $employee = $this->employeeFetcher->getEmployee($id);
        return view('admin.employee.edit-contract', compact('employee'));
    }

    public function downloadContract(Request $request)
    {
        return Storage::disk('public')->download(ContractUploadService::CONTRACT_DIRECTORY . $request['contract-file']);
    }

    public function editContract(EditContractRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            if ($request->file('file') !== null) {
                $fileName = $this->contractUpload->upload($request->file('file'), $employee->getContractPath(), $employee->contract_file);
                $employee->uploadContract($fileName);
            }

            $employee->editContractExpiration(Carbon::createFromFormat('Y-m-d', $request['contract_expiration']));

        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('edit-employee-contract-form', ['id' => $id])->with('success', 'Contract successfully edited');
    }

    public function showAttachManagerForm($id)
    {
        $managers = $this->userFetcher->getManagersForAttach($id);
        return view('admin.employee.attach-manager', compact('managers', 'id'));
    }

    public function attachManager(ChangeManagersRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $request['managers'] = User::where('role', 'manager')
                ->whereIn('id', $request['managers'])
                ->pluck('id')
                ->toArray();

            $employee->attachManager($request['managers']);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('attach-manager-form', ['id' => $id])->with('success', 'Manager successfully attached');
    }

    public function showDetachManagerForm($id)
    {
        $managers = $this->userFetcher->getManagersForDetach($id);;
        return view('admin.employee.detach-manager', compact('managers', 'id'));
    }

    public function detachManager(ChangeManagersRequest $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $request['managers'] = User::where('role', 'manager')
                ->whereIn('id', $request['managers'])
                ->pluck('id')
                ->toArray();

            $employee->detachManager($request['managers']);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('detach-manager-form', ['id' => $id])->with('success', 'Manager successfully detached');
    }
}
