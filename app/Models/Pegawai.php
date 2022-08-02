<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table="pegawai";
    protected $primaryKey = "nip";
    protected $fillable=["nip","id_jenis", "nama_pegawai", "tempat_lahir", "tanggal_lahir", "agama" ,"alamat", "no_telp", "foto"];

    public function jenis_pegawai()
    {
        return $this->belongsTo(JenisPegawai::class, 'id_jenis');
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'nip');
    }

    public function lembur()
    {
        return $this->hasMany(Lembur::class, 'nip');
    }

    public function gaji()
    {
        return $this->hasOne(Gaji::class, 'nip');
    }
}
