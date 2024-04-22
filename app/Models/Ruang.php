<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruangs';
    protected $fillable = ['nama', 'jenis', 'tempat', 'status' ];

    public function acaras()
    {
        return $this->hasMany(User::class, 'tempat', 'id');
    }
}
