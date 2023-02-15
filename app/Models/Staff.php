<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'staff_type',
        'specialty',
        'current_hospital',
        'age',
        'rate',
        'graduation_year',
        'experience_years',
        'experiences',
        'about',
        'salary',
        'certificate_count'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'staff';

}
