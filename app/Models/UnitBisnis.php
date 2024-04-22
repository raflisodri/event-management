<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBisnis extends Model
{
    use HasFactory;
    protected $table = 'unit_bisnis';
    protected $fillable = ['nama', 'status'];

    public function users()
    {
        return $this->hasMany(User::class, 'unit_bisnis', 'id');
    }
}
