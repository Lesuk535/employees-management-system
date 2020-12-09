<?php

namespace App\Models\Employee\Entity;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'country',
        'city',
        'region',
        'street'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
