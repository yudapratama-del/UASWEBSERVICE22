<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{   
    // auth login
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]); // kecuali index dan show
    }
    
    //view gaji
    public function index()
    {
        $datas = Gaji::all();
        return response()->json([
            'pesan' => 'Data Berhasil Di temukan!',
            'data' => $datas
        ], 200);
    }

    //view by id_gaji
    public function show($id_gaji)
    {
        $data = Gaji::find($id_gaji);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }

    //create gaji
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_gaji' => 'required|numeric|unique:gaji',
            'nip' => 'required|numeric',
            'id_jenis' => 'required|numeric',
            'jumlah_absen' => 'required|numeric',
            'jumlah_lembur' => 'required|numeric',
            'tunjangan_anak' => 'required|numeric',
            'tunjangan_istri' => 'required|numeric',
            'tunjangan_pokok' => 'required|numeric',
            'potongan_ansuransi' => 'required|numeric',
            'total' => 'required|numeric'
        ]);
        if ($validasi->fails()){
            return response()->json(['pesan' => 'Data Gagal Ditambahkan!', 'data' => $validasi->errors()->all()], 400);
        }
        $data = Gaji::create($request->all());
        return response()->json(['pesan'=>'Data Berhasil Ditambahkan', 'data'=>$data], 200);
        
    }

    //update pegawai
    public function update(Request $request, $id_gaji)
    {
        $gaji = Gaji::find($id_gaji);
        if (empty($gaji)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nip' => 'required|numeric',
                'id_jenis' => 'required|numeric',
                'jumlah_absen' => 'required|numeric',
                'jumlah_lembur' => 'required|numeric',
                'tunjangan_anak' => 'required|numeric',
                'tunjangan_istri' => 'required|numeric',
                'tunjangan_pokok' => 'required|numeric',
                'potongan_ansuransi' => 'required|numeric',
                'total' => 'required|numeric'
            ]);
            // menambahkan validasi jika request->id dikirimkan tidak sama dengan nip
            if ($request->id != $gaji->id) {
                $validasi['id_gaji'] = 'required|numeric|unique:pegawai';
            }
            else if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $gaji->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $gaji], 200);
        }
    }

    //delete pegawai
    public function destroy($id_gaji)
    {
        $gaji = Gaji::find($id_gaji);
        if (empty($gaji)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $gaji->delete();
            return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $gaji]);
        }
    }

    // test relasi
    public function indexRelasi()
    {
        $gaji = Gaji::with('pegawai', 'jenis_pegawai')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $gaji], 200);
    }
}
