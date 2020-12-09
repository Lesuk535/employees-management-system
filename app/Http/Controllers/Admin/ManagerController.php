<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\QueryModel\Employee\EmployeeFetcher;
use App\QueryModel\User\UserFetcher;

class ManagerController extends Controller
{
    private UserFetcher $userFetcher;
    private EmployeeFetcher $employeeFetcher;

    public function __construct(
        UserFetcher $userFetcher,
        EmployeeFetcher $employeeFetcher
    ) {
        $this->middleware('can:admin');
        $this->userFetcher = $userFetcher;
        $this->employeeFetcher = $employeeFetcher;
    }

    public function index()
    {
        $managers = $this->userFetcher->getAllManagers();
        return view('admin.manager.index', compact('managers'));
    }

    public function showManager($id)
    {
        $manager = $this->userFetcher->getManagerById($id);
        $employees = $this->employeeFetcher->getEmployeesByManager($manager->id);
        return view('admin.manager.show-manager', compact('manager', 'employees'));
    }

}
