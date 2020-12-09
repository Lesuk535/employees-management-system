<?php

declare(strict_types=1);

namespace App\Models\User\Entity;

use App\Models\Employee\Entity\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models\User\Entity
 *
 * @property Carbon $created_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public static function register(Name $name, Email $email, string $password, Role $role)
    {
        return static::create([
            'name' => $name->getValue(),
            'email' => $email->getValue(),
            'password' => Hash::make($password),
            'status' => Status::active()->getValue(),
            'role' => $role->getValue()
        ]);
    }

    public function inactive()
    {
        if (!$this->isExpired()) {
            throw new \DomainException('The account can be valid for 1 year, you cannot deactivate it ahead of time');
        }
        $this->update(['status' => Status::inactive()->getValue()]);
    }

    public function isExpired()
    {
        return $this->created_at->addYear()->toDate() <= new \DateTimeImmutable();
    }

    public function getStatus(): Status
    {
        return new Status($this->status);
    }

    public function getRoles(): Role
    {
        return new Role($this->role);
    }
}
