<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Pegawai; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{   
    // auth login
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]); // kecuali index dan show
    }

    //view pegawai
    public function index()
    {
        $datas = Pegawai::all();
        return response()->json([
            'pesan' => 'Data Berhasil Di temukan!',
            'data' => $datas
        ], 200);
    }

    //view by nip
    public function show($nip)
    {
        $data = Pegawai::find($nip);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }

    //create pegawai
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nip' => 'required|numeric|unique:pegawai',
            'id_jenis' => 'required|numeric',
            'nama_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'foto' => 'required'
        ]);
        if ($validasi->fails()){
            return response()->json(['pesan' => 'Data Gagal Ditambahkan!', 'data' => $validasi->errors()->all()], 400);
        }
        $data = Pegawai::create($request->all());
        return response()->json(['pesan'=>'Data Berhasil Ditambahkan', 'data'=>$data], 200);
        
    }

    //update pegawai
    public function update(Request $request, $nip)
    {
        $pegawai = Pegawai::find($nip);
        if (empty($pegawai)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'id_jenis' => 'required|numeric',
                'nama_pegawai' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'foto' => 'required'
            ]);
            // menambahkan validasi jika request->id dikirimkan tidak sama dengan nip
            if ($request->id != $pegawai->id) {
                $validasi['nip'] = 'required|numeric|unique:pegawai';
            }
            else if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $pegawai->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $pegawai], 200);
        }
    }

    //delete pegawai
    public function destroy($nip)
    {
        $pegawai = Pegawai::find($nip);
        if (empty($pegawai)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $pegawai->delete();
            return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pegawai]);
        }
    }

    // test relasi
    public function indexRelasi()
    {
        $pegawai = Pegawai::with('jenis_pegawai', 'absen', 'lembur', 'gaji')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $pegawai], 200);
    }
}
