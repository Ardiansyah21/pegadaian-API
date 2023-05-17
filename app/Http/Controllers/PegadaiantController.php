<?php

namespace App\Http\Controllers;

use App\Models\Pegadaiant;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;


class PegadaiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(REQUEST $request)
    {
        $search = $request->search_nama;
        $limit = $request->limit;
        $Pegadaiants = Pegadaiant::where('nama', 'LIKE', '%'.$search.'%')->limit($limit)->get();
        
        // $Pegadaiants = Pegadaiant::all();
        if($Pegadaiants){
            //kalao data berhasil di ambil
            return ApiFormatter::createApi(200, 'success',  $Pegadaiants);
        }else {
            //kalo data gagal di ambil
            return ApiFormatter::createApi(400, 'failed', $error->getMassage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data
        try {
            $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'age' => 'required',
                'no_tlp' => 'required',
                'nik' => 'required',
                'date' => 'required',


            ]);
            
           //mengirim data baru ke table students lewat model students
            $Pegadaiants = Pegadaiant::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'age' => $request->age,
                'no_tlp' => $request->no_tlp,
                'nik' => $request->nik,
                'date' => $request->date,


                

          
            ]);
             //cari data barus yang berhasil di simpan, cari berdasarkan id lewat id dari $students yang di atas
         $getDataSaved = Pegadaiant::where('id', $Pegadaiants->id)->first();

         if($getDataSaved){
            return ApiFormatter::createApi(200, 'success',  $getDataSaved);
        }else {
            return ApiFormatter::createApi(400, 'failed',);
        }

     } catch (Exception $error){
        return ApiFormatter::createApi(400, 'failed', $error);
    }
  

}

public function createToken()
    {
    return csrf_token();
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       try {
        //ambil data darib tabel student yang id nya sama kaya $id dari path routnya
       //where dan find fungsi mencari, bedanya where nyari berdasarkan
        $Pegadaiants = Pegadaiant::find($id);
        if ($Pegadaiants){
            //kalau data berhasil diambil, tampilkan data sati $students nya dengan tanda status code 200
            return ApiFormatter::createAPI(200, 'succes', $Pegadaiants);
        }else{
            //kalau data gagal di ambil/data gada, yang di kembalikan status code 400
            return ApiFormatter::createAPI(400, 'failed');
        }
       } catch(Exception $error){
        //kalai pas try ada error, deskripsi errornya di tamilkan statsu coede 400

        return ApiForematter::createAPI(400, 'error', $error->getMessage());
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegadaiant $pegadaiant)
    {
        //
    }


    public function trash()
    {
        try{
            $Pegadaiants = Pegadaiant::onlyTrashed()->get();
            if($Pegadaiants){
                //kalau data berhasil diambil, tampilkan data sati $students nya dengan tanda status code 200
            return ApiFormatter::createAPI(200, 'succes', $Pegadaiants);
        }else{
            //kalau data gagal di ambil/data gada, yang di kembalikan status code 400
            return ApiFormatter::createAPI(400, 'failed');
        }
       } catch(Exception $error){
        //kalai pas try ada error, deskripsi errornya di tamilkan statsu coede 400

        return ApiForematter::createAPI(400, 'error', $error->getMessage());
            
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            //cek validasi inputan pada body postaman
            $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'age' => 'required',
                'no_tlp' => 'required',
                'nik' => 'required',
                'date' => 'required',

            ]);
            //ambil data yang akan di ubah
            $Pegadaiants = Pegadaiant::find($id);
            //update data yang telah diambil diatas
            $Pegadaiants = Pegadaiant::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'age' => $request->age,
                'no_tlp' => $request->no_tlp,
                'nik' => $request->nik,
                'date' => $request->date,

 
            ]);
            //cari data yang berhasil diubah tadi cari berdasarakn id dari $student yang di ambil di awal
            $dataTerbaru = Pegadaiant::where('id', $Pegadaiants->id)->first();

            if($dataTerbaru){
                //jika update berhasil, tampilkan data dari $updatestudents diatas (data yg sudah berhasil ditambah)
            
            return ApiFormatter::createAPI(200, 'succes', $dataTerbaru);
        } else{
            return ApiFormatter::createAPI(400, 'failed');

        }
    } catch (Exception $error){
        // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
        return ApiFormatter::createAPI(400, 'error', $error->getMessage());

    }
}

 public function restore($id)
 {
    try {
        $Pegadaiants = Pegadaiant::onlyTrashed()->where('id', $id);
        $Pegadaiants->restore();
        $dataRestore = Pegadaiant::where('id', $id)->first();
        if($dataRestore){
            //jika update berhasil, tampilkan data dari $updatestudents diatas (data yg sudah berhasil ditambah)
        return ApiFormatter::createAPI(200, 'succes', $dataRestore);
    } else{
        return ApiFormatter::createAPI(400, 'failed');

    }
} catch (Exception $error){
    // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
    return ApiFormatter::createAPI(400, 'error', $error->getMessage());
    }
 }

 public function permanenDelete($id)
{

 try {

    $Pegadaiants = Pegadaiant::onlyTrashed()->where('id', $id);
    $proses = $Pegadaiants->forceDelete();
    if($proses){
        return ApiFormatter::createAPI(200, 'succes', 'Data Terhapus permanenen');
            } else{
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error){
            // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
         return ApiForematter::createAPI(400, 'error', $error->getMessage());

    }

 }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            //ambil data yang mau di hapus
            $Pegadaiants = Pegadaiant::find($id);
            //hapus data yang ambil di atas
            $cekBerhasil = $Pegadaiants->delete();
            if($cekBerhasil){
                
                return ApiFormatter::createAPI(200, 'succes', 'Data Terhapus');
            } else{
                return ApiFormatter::createAPI(400, 'failed');
    
            }
        } catch (Exception $error){
            // jika di bari kode try sudah trioubel, error dimunculkan dengan sesc errornya apa dengan statsu code 400
            return ApiForematter::createAPI(400, 'error', $error->getMessage());
    
        }
    }
}
