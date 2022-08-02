<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LemburController extends Controller
{   
    // auth login
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]); // kecuali index dan show
    }
    
    //view Lembur
    public function index()
    {
        $datas = Lembur::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }

    public function show($id_lembur)
    {
        $data = Lembur::find($id_lembur);
        if (empty($data)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        }else{
            return response()->json(['pesan'=>'Data Berhasil Ditemukan', 'data'=>$data], 200);
        }
    }

    // create lembur
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_lembur' => 'required|numeric|unique:lembur', 
            'nip' => 'required|numeric', 
            'tanggal' => 'required', 
            'status_lembur' => 'required', 
            'cetak' => 'required'
        ]);
        if ($validasi->fails()){
            return response()->json(['pesan' => 'Data Gagal Ditambahkan!', 'data' => $validasi->errors()->all()], 400);
        }
        $data = Lembur::create($request->all());
        return response()->json(['pesan'=>'Data Berhasil Ditambahkan', 'data'=>$data], 200);
    }

    //update Lembur
    public function update(Request $request, $id_lembur)
    {
        $lembur = Lembur::find($id_lembur);
        if (empty($lembur)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nip' => 'required|numeric', 
                'tanggal' => 'required', 
                'status_lembur' => 'required', 
                'cetak' => 'required'
            ]);
            // menambahkan validasi jika request->id dikirimkan tidak sama dengan nip
            if ($request->id != $lembur->id) {
                $validasi['id_lembur'] = 'required|numeric|unique:lembur';
            }
            else if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $lembur->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $lembur], 200);
        }
    }

    //delete lembur
    public function destroy($id_lembur)
    {
        $lembur = Lembur::find($id_lembur);
        if (empty($lembur)){
            return response()->json(['pesan'=>'Data Tidak Ditemukan', 'data'=>''], 404);
        } else {
            $lembur->delete();
            return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $lembur]);
        }
    }

    // test relasi
    public function indexRelasi()
    {
        $lembur = Lembur::with('pegawai')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $lembur], 200);
    }
}
