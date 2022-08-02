<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = "absen";
    protected $primaryKey = "id_absen";
    protected $fillable=["id_absen", "nip", "tanggal", "status_absen", "cetak"];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip');
    }
}
