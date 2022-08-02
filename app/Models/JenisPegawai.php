<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPegawai extends Model
{
    use HasFactory;
    protected $table="jenis_pegawai";
    protected $primaryKey = "id_jenis";
    protected $fillable=["id_jenis","jumlah_gaji", "jumlah_gaji_lembur", "nama_jenis", "keterangan"];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jenis');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'id_jenis');
    }
 
}
