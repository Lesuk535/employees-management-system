<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employee\Services\ContractUploadService;
use App\QueryModel\Employee\EmployeeFetcher;
use App\QueryModel\User\UserFetcher;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    private UserFetcher $userFetcher;
    private EmployeeFetcher $employeeFetcher;

    public function __construct(
        UserFetcher $userFetcher,
        EmployeeFetcher $employeeFetcher
    ) {
        $this->middleware('auth');
        $this->userFetcher = $userFetcher;
        $this->employeeFetcher = $employeeFetcher;
    }

    public function index()
    {
        $employees = $this->employeeFetcher->getEmployeesByManager(Auth::user()->id);
        return view('manager.index', compact('employees'));
    }

    public function showManager($id)
    {
        $manager = $this->userFetcher->getManagerById($id);
        $employees = $this->employeeFetcher->getEmployeesByManager($manager->id);
        return view('admin.manager.show-manager', compact('manager', 'employees'));
    }

    public function showContract(Request $request)
    {
        return Storage::disk('public')->response(ContractUploadService::CONTRACT_DIRECTORY . $request['contract-file']);
    }
}
