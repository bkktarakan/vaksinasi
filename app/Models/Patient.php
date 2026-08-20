<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'barcode_number', 'e_icv_issue_date', 'passport_number', 'name', 
        'place_of_birth', 'date_of_birth', 'gender', 'phone', 'address', 'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function records()
    {
        return $this->hasMany(VaccinationRecord::class);
    }
}
