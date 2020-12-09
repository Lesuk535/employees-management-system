<?php

declare(strict_types=1);

namespace App\QueryModel\Employee;

class EmployeeView
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $contract_date;
    public $contract_expiration;
    public $contract_file;
    public $address_id;
    public $country;
    public $city;
    public $region;
    public $street;

    public function getContractPath()
    {
        return sprintf('/%s/%s/%s', $this->id, date('Y', strtotime($this->contract_date)), $this->contract_file);
    }

    public function getContractDate()
    {
        return date('Y-m-d', strtotime($this->contract_expiration));
    }
}
