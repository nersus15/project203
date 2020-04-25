<?php

namespace App\Http\Controllers;

use App\ujian as ujianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;

class ujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $data = ujianModel::all();
       $extra_js_table = File::get(public_path('js/table.js'));
       $modal_form = array(
           'id' => 'modal-tambah-data-ujian',
           'title' => 'tambah data ujian',
           'tipe' => 'form',
           'extra_js' => File::get(public_path('js/modal.js')),
           'form' => array(
                'id' => 'form-tambah-ujian',
                'action' => url('ujian'),
                'method' => 'post',
                'input' => array(
                    [
                        'tipe' => 'text',
                        'name' => 'matkul',
                        'id' => 'matkul',
                        'label' => 'Nama Matakuliah',
                        "attribute" => array(
                            'required' => true
                        )
                    ],
                    [
                        'tipe' => 'text',
                        'name' => 'dosen',
                        'id' => 'dosen',
                        'label' => 'Nama Dosen',"attribute" => array(
                            'required' => true
                        ),
                    ],
                    [
                        'tipe' => 'number',
                        'name' => 'soal',
                        'id' => 'soal',
                        'label' => 'Jumlah Soal',
                        "attribute" => array(
                            'min' => 0,
                            'required' => true
                        )
                    ],
                    [
                        'tipe' => 'textarea',
                        'name' => 'keterangan',
                        'id' => 'keterangan',
                        'label' => 'Keterangan',
                        "attribute" => array(
                            'required' => true
                        )
                    ],

                )
           )
        );
        $modal_notif = array(
            'title' => '',
            'tipe' => 'notif',
            'id' => 'modal-notif-tambah-data',
            'notif' => array(
                'message' => ''
            )
        );
        $toolbar = array(
            '<li id="btn-add" style="margin: 0 1%" data-modalid = "modal-tambah-data-ujian" class="btn btn-toolbar btn-sm pull-right btn-outline-primary">' . "Tambah data". '</li>'
        );
        $modal = array($modal_form, $modal_notif);
        $data_view = array(
            'master' => 'template/index_ujian',
            'data' => $data,
            'modalid' => array('modal-tambah-data-ujian', 'modal-notif-tambah-data'),
            'modalData' => $modal,
            'extra_js' => $extra_js_table,
            'conf' => array(
                'ada-toolbar' => true, 
                'toolbar' => $toolbar,
            )
        );
       return view('compui/table', $data_view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $post = new ujianModel();
        $post->nama_mk = $request->matkul;
        $post->dosen = $request->dosen;
        $post->jumlah_soal = $request->soal;
        $post->keterangan = $request->keterangan;
        $post->updated_at = null;
        try{
            $post->save();
        }catch(Throwable $err){
            return response()->json(['message'=>$err], 500);
        }
        return response()->json(["message"=>"Berhasil menambahkan data ujian Matakuliah " . $request->matkul]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ujian = ujianModel::find($id);
        $ujian->nama_mk = $request->matkul;
        $ujian->dosen = $request->dosen;
        $ujian->jumlah_soal = $request->soal;
        $ujian->keterangan = $request->keterangan;
        $ujian->updated_at = date('Y-m-d');
        try{
            $ujian->save();
        }catch(Throwable $err){
            return response()->json(['message'=>$err], 200);
        }
        return response()->json(["message"=>"Berhasil merubah data ujian Matakuliah " . $request->matkul]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ujian = ujianModel::find($id);
        try{
            $ujian->delete();
        }catch( Throwable $err){
            return response()->json(['message'=>$err], 200);
        }
        return response()->json(["message"=>"Berhasil menghapus data ujian Matakuliah " . $ujian->nama_mk]); 
    }
}
