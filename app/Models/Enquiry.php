<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'business_name',
        'company_type',
        'number_of_travelers',
        'travel_date',
        'destination',
        'message',
    ];
}
