<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'ktp_number',
        'date_of_birth',
        'email',
        'province_address',
        'city_address',
        'street_address',
        'zip_code',
        'current_position',
        'bank_account',
        'bank_account_number',
        'ktp_file',
    ];
}
