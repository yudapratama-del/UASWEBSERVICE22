<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisPegawaiController extends Controller
{   
    // auth login
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]); // kecuali index dan show
    }
    
    //view Jenis Pegawai
    public function index()
    {
        $datas = JenisPegawai::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }

    public function show($id_jenis)
    {
        $data = JenisPegawai::find($id_jenis);
        if (empty($data)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        }else{
            return response()->json(['pesan'=>'Data Berhasil Ditemukan', 'data'=>$data], 200);
        }
    }

    // create JenisPegawai
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_jenis' => 'required|numeric|unique:jenis_pegawai', 
            'jumlah_gaji' => 'required', 
            'jumlah_gaji_lembur' => 'required', 
            'nama_jenis' => 'required', 
            'keterangan' => 'required'
        ]);
        if ($validasi->fails()){
            return response()->json(['pesan' => 'Data Gagal Ditambahkan!', 'data' => $validasi->errors()->all()], 400);
        }
        $data = JenisPegawai::create($request->all());
        return response()->json(['pesan'=>'Data Berhasil Ditambahkan', 'data'=>$data], 200);
    }

    //update JenisPegawai
    public function update(Request $request, $id_jenis)
    {
        $jenis_pegawai = JenisPegawai::find($id_jenis);
        if (empty($jenis_pegawai)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'jumlah_gaji' => 'required', 
                'jumlah_gaji_lembur' => 'required', 
                'nama_jenis' => 'required', 
                'keterangan' => 'required'
            ]);
            // menambahkan validasi jika request->id dikirimkan tidak sama dengan nip
            if ($request->id != $jenis_pegawai->id) {
                $validasi['id_jenis'] = 'required|numeric|unique:jenis_pegawai';
            }
            else if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $jenis_pegawai->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $jenis_pegawai], 200);
        }
    }

    //delete jenis_pegawai
    public function destroy($id_jenis)
    {
        $jenis_pegawai = JenisPegawai::find($id_jenis);
        if (empty($jenis_pegawai)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $jenis_pegawai->delete();
            return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $jenis_pegawai]);
        }
    }

    // test relasi
    public function indexRelasi()
    {
        $jenis_pegawai = JenisPegawai::with('pegawai')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $jenis_pegawai], 200);
    }
}
