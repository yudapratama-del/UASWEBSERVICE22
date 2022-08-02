<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;
    protected $table = "lembur";
    protected $primaryKey = "id_lembur";
    protected $fillable=["id_lembur", "nip", "tanggal", "status_lembur", "cetak"];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip'); 
    }
}
