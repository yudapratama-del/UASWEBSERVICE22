<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller 
{   
    // auth login
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]); // kecuali index dan show
    }
    
    //view absen
    public function index()
    {
        $datas = Absen::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }

    public function show($id_absen)
    {
        $data = Absen::find($id_absen);
        if (empty($data)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        }else{
            return response()->json(['pesan'=>'Data Berhasil Ditemukan', 'data'=>$data], 200);
        }
    }

    // create absen
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_absen' => 'numeric|unique:absen', 
            'nip' => 'required|numeric', 
            'tanggal' => 'required', 
            'status_absen' => 'required', 
            'cetak' => 'required'
        ]);
        if ($validasi->fails()){
            return response()->json(['pesan' => 'Data Gagal Ditambahkan!', 'data' => $validasi->errors()->all()], 400);
        }
        $data = Absen::create($request->all());
        return response()->json(['pesan'=>'Data Berhasil Ditambahkan', 'data'=>$data], 200);
    }

    //update Absen
    public function update(Request $request, $id_absen)
    {
        $absen = Absen::find($id_absen);
        if (empty($absen)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nip' => 'required|numeric', 
                'tanggal' => 'required', 
                'status_absen' => 'required', 
                'cetak' => 'required'
            ]);
            // menambahkan validasi jika request->id dikirimkan tidak sama dengan nip
            if ($request->id != $absen->id) {
                $validasi['id_absen'] = 'required|numeric|unique:absen';
            }
            else if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $absen->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $absen], 200);
        }
    }

    //delete absen
    public function destroy($id_absen)
    {
        $absen = Absen::find($id_absen);
        if (empty($absen)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $absen->delete();
            return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $absen]);
        }
    }

    // test relasi
    public function indexRelasi()
    {
        $absen = Absen::with('pegawai')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $absen], 200);
    }
}
