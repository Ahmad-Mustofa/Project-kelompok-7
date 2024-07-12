<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLayanan extends Model
{
    use HasFactory;

    protected $table = 'detail_layanan';

    protected $fillable = ['pekerjaan', 'biaya', 'layanan_id', 'pj_montir_id'];

    public function Layanan() {
        return $this->hasMany(Layanan::class, 'layanan_id');
    }
    public function Montir() {
        return $this->hasMany(Montir::class, 'pj_montir_id');
    }
}
