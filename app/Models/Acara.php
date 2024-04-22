<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acaras';

    protected $fillable = [
        'judul',
        'tgl_acara',
        'wk_awal',
        'wk_akhir',
        'koordinator',
        'wk_res',
        'tp_acara',
        'deskripsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'koordinator', 'id');
    }
    
    public function ruangs()
    {
        return $this->belongsTo(User::class, 'tempat', 'id');
    }

    public function partisipan()
    {
        return $this->hasMany(Partisipan::class, 'acara_id', 'id');
    }
}
