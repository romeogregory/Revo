<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'max_boot_time',
        'concurrents',
        'price',
        'duration',
        'recurring',
        'api_access',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
