<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverLetter extends Model
{
    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'job_description',
        'cover_letter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}