<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTempat extends Model
{
    use HasFactory;
    protected $table = 'detail_tempats';
    protected $fillable = ['id_acara', 'tempat'];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara', 'id');
    }

    // Definisi relasi dengan model Ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'tempat', 'id');
    }
}
