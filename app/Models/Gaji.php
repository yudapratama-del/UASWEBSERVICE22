<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table="gaji";
    protected $primaryKey = "id_gaji";
    protected $fillable=["id_gaji","nip", "id_jenis", "jumlah_absen", "jumlah_lembur", "tunjangan_anak" ,"tunjangan_istri", "tunjangan_pokok", "potongan_ansuransi", "total"];

    public function jenis_pegawai()
    {
        return $this->belongsTo(JenisPegawai::class, 'id_jenis');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip'); 
    }
}
