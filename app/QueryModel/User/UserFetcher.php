<?php

declare(strict_types=1);

namespace App\QueryModel\User;

use App\QueryModel\BaseFetcher;
use Illuminate\Support\Facades\DB;

final class UserFetcher extends BaseFetcher
{
    public function getActiveManagers()
    {
        $this->setCustomObjectMode(ManagerView::class);

        $manager = DB::table('users')->select(['id', 'name'])
            ->where('status', 'active')
            ->where('role', 'manager')->get();

        return $manager;
    }

    public function getAllManagers()
    {
        $this->setCustomObjectMode(ManagerView::class);

        $manager = DB::table('users')
            ->where('role', 'manager')->get();
        return $manager;
    }

    public function getManagerById($id)
    {
        $this->setCustomObjectMode(ManagerView::class);

        $manager = DB::table('users')
            ->where('role', 'manager')
            ->where('id', $id)
            ->get();

        return $manager->first();
    }

    public function getManagersForAttach($id)
    {
        $this->setCustomObjectMode(ManagerView::class);

        $users = DB::table('employee_user')->select(['user_id'])
            ->where('employee_id', $id)->get()->toArray();

        $managers = [];

        foreach ($users as $user) {
            $managers[] = $user->user_id;
        }

        $users = DB::table('users')->select(['id', 'name'])
            ->where('status', 'active')
            ->where('role', 'manager')
            ->whereNotIn('id', $managers)
            ->get();

        return $users;
    }

    public function getManagersForDetach($id)
    {
        $manager = DB::table('users')->select(['id', 'name'])
            ->join('employee_user', 'users.id', '=', 'employee_user.user_id')
            ->where('status', 'active')
            ->where('role', 'manager')
            ->where('employee_user.employee_id', $id)
            ->get();

        return $manager;
    }
}
