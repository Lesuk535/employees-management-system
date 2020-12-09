<?php

declare(strict_types=1);

namespace App\Models\Employee\Entity;

use App\Models\User\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $name
 * @property $email
 * @property $phone
 * @property $address
 * @property Carbon $contract_date
 * @property $contract_expiration
 */
class Employee extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'contract_file',
        'contract_date',
        'contract_expiration',
    ];

    protected $casts = [
        'contract_date' => 'datetime:Y-m-d',
        'contract_expiration' => 'datetime:Y-m-d'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public static function new(
        Name $name,
        Email $email,
        Phone $phone,
        Carbon $contractDate,
        Carbon $contractExpiration
    ) {
        self::validationContractDates($contractDate, $contractExpiration);

        $employee = static::create([
            'name' => $name->getValue(),
            'email' => $email->getValue(),
            'phone' => $phone->getValue(),
            'contract_date' => $contractDate,
            'contract_expiration' => $contractExpiration
        ]);

        return $employee;
    }

    public function attachManager(array $managerIds)
    {
        $this->users()->attach($managerIds);
    }

    public function detachManager(array $managerIds)
    {
        $this->users()->detach($managerIds);
    }

    public function createAddress(
        string $country,
        string $city,
        string $region,
        string $street
    ) {
        $this->address()->create([
            'country' => $country,
            'city' => $city,
            'region' => $region,
            'street' => $street
        ]);

    }

    public function editEmployee(Name $name, Email $email, Phone $phone)
    {
        $this->update(['name' => $name->getValue(), 'email' => $email->getValue(), 'phone' => $phone->getValue()]);
    }

    public function editAddress(string $country, string $city, string $region, string $street)
    {
        $this->address()->update([
             'country' => $country,
             'city' => $city,
             'region' => $region,
             'street' => $street
        ]);
    }

    public function editContractExpiration(Carbon $contractExpiration)
    {
        self::validationContractDates($this->contract_date, $contractExpiration);

        $this->update([
            'contract_expiration' => $contractExpiration
        ]);

    }

    public function uploadContract(string $contract)
    {
        $this->update(['contract_file' => $contract]);
    }

    public function getContractPath()
    {
        return sprintf('%s/%s', $this->id, date('Y', strtotime($this->contract_date->toDateString())));
    }

    private static function validationContractDates(Carbon $contractDate, Carbon $contractExpiration)
    {
        if ($contractDate->toDate() >= $contractExpiration->toDate()) {
            throw new \DomainException('The term of the contract may not be less than the date of creation of the contract');
        }
    }
}
