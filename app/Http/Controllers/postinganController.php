<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\postingan;
use Illuminate\Http\Request;

class postinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $tampil = postingan::orderBy('id','DESC')->paginate(10);
        $posisi = $request->session()->get('posisi');
        $penulis = $request->session()->get('penulis');
        $nim = $request->session()->get('nim');

        if($posisi == 'admin' && $penulis=='penulis'){
            $tampil = postingan::when($request->keyword, function($query) use ($request){
                $query->where('postingan.judul','like',"%{$request->keyword}%")
                    ->orWhere('postingan.created_at','like',"%{$request->keyword}%")
                    ->orWhere('postingan.tag','like',"%{$request->keyword}%")
                    ->orWhere('anggota.nama','like',"%{$request->keyword}%");
            })->orderBy('postingan.id','DESC')
            ->join('anggota','anggota.nim','=','postingan.penulis')
            ->select('postingan.id','postingan.judul','postingan.tag','anggota.nama','postingan.created_at')
            ->paginate($request->limit ? $request->limit : 10);
        }else if ($posisi=='anggota'  && $penulis=='penulis') {
            $tampil = postingan::when($request->keyword, function($query) use ($request){
                $query->where('postingan.judul','like',"%{$request->keyword}%")
                    ->orWhere('postingan.created_at','like',"%{$request->keyword}%")
                    ->orWhere('postingan.tag','like',"%{$request->keyword}%");
            })->orderBy('postingan.id','DESC')
            ->join('anggota','anggota.nim','=','postingan.penulis')
            ->where('postingan.penulis', $nim)
            ->select('postingan.id','postingan.judul','postingan.tag','anggota.nama','postingan.created_at')
            ->paginate($request->limit ? $request->limit : 10);
        }
        
       

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesServer/data_postingan', [
            'postingan' => $tampil
        ]);
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $format = strtolower($extension);

            if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                
                $cek = $request->file('upload')->move(\base_path() ."/public/images", $fileName);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('/images/'.$fileName); 
                $msg = 'Gambar Berhasil diupload'; 
            }else {
                $CKEditorFuncNum = 1;
                $url = '';
                $msg = 'Format bukan gambar';
            }
            
            
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }   
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagesServer/tulis_postingan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required'
        ]);
            
            // penulis
            $cek_penulis = $request->session()->get('penulis');
            $posisi = $request->session()->get('posisi');

            if(($posisi=='admin' || $posisi=='bendahara' || $posisi=='anggota') && $cek_penulis=='penulis'){
                $judul = $request->judul;
                $tag = $request->tag_postingan;
                $penulis = $request->session()->get('nim');

    
                $konten_mentah = $request->konten;
                $konten = trim($konten_mentah);
                $konten = stripslashes($konten_mentah);
                $konten = htmlspecialchars($konten_mentah);
    
                if ($request->hasFile('gambar_utama')) {
                    $originName = $request->file('gambar_utama')->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $request->file('gambar_utama')->getClientOriginalExtension();
                    $size= $request->file('gambar_utama')->getSize();
                    
    
                    $format = strtolower($extension);
                    if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                        if ($size <= 3097152) {
                            $fileName = $fileName.'_'.time().'.'.$extension;
                        }else {
                            return redirect('data_postingan/create')->with('toast_error','Gambar Utama maximal 3Mb');
                        }
                    }else {
                        $fileName= 'none.jpg';
                    }
    
                }else {
                    $fileName= 'none.jpg';
                }
    
                $postingan = new postingan;
                $postingan->judul = $judul;
                $postingan->gambar_utama = $fileName;
                $postingan->penulis = $penulis;
                $postingan->tag = $tag;
                $postingan->lihat = 0;
                $postingan->konten = $konten;
                $postingan->save();
    
                if ($postingan) {
                    if ($request->hasFile('gambar_utama')) {
                        $upload = $request->file('gambar_utama')->move(\base_path() ."/public/images/postingan", $fileName);
                    }
                    
                    return redirect('data_postingan')->with('toast_success','Data berhasil ditambahkan');
                }else {
                    return redirect('data_postingan/create')->with('toast_error','Data gagal ditambahkan');
    
                }


            }else {
                return redirect('data_postingan')->with('toast_error','ERROR');
            }

            
            
            
            
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(postingan $postingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, postingan $postingan, $id)
    {
      
        $posisi = $request->session()->get('posisi');
        $penulis = $request->session()->get('penulis');
        $nim = $request->session()->get('nim');
        if($posisi=='admin' && $penulis=='penulis') {
            $tampil = $postingan->where('id',$id)->first();
        }else if(($posisi=='bendahara' || $posisi=='anggota') && $penulis=='penulis'){
            $cek = $postingan->join('anggota','anggota.nim','=','postingan.penulis')
            ->where('postingan.id',$id)
            ->where('postingan.penulis',$nim)
            ->count();

            if($cek==1) {
                $tampil = $postingan->where('id',$id)->first();
            }else {
                return redirect('data_postingan')->with('toast_error','terjadi kesalahan');
            }
        }

        return view('pagesServer.edit_postingan',[
            'postingan' => $tampil
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, postingan $postingan, $id)
    {
        $cek_posisi = $request->session()->get('posisi');
        $cek_penulis = $request->session()->get('penulis');
        $cek_nim = $request->session()->get('nim');

        if($cek_posisi=='admin' && $cek_penulis=='penulis') {
            $lanjut = true;
        }else if ($cek_posisi=='anggota' && $cek_penulis=='penulis'){
            $cek = $postingan->join('anggota','anggota.nim','=','postingan.penulis')
            ->where('postingan.id',$id)
            ->where('postingan.penulis',$cek_nim)
            ->count();
            if($cek==1){
                $lanjut=true;
            }else {
                $lanjut=false;
            }
        }else {
            $lanjut=false;
        }

        if($lanjut){
            $ambil_query = $postingan->where('id',$id)->first();
            $gambar_lama = $ambil_query->gambar_utama;
    
            //penulis
            $penulis = $request->session()->get('nim');
            $judul = $request->judul;
            $tag = $request->tag_postingan;
    
            $konten_mentah = $request->konten;
            $konten = trim($konten_mentah);
            $konten = stripslashes($konten_mentah);
            $konten = htmlspecialchars($konten_mentah);
    
                if ($request->hasFile('gambar_utama')) {
                    $originName = $request->file('gambar_utama')->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $request->file('gambar_utama')->getClientOriginalExtension();
                    $size= $request->file('gambar_utama')->getSize();
        
                    $format = strtolower($extension);
                    if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                        if ($size<=3097152) {
                            $gambar_utama = $fileName.'_'.time().'.'.$extension;
                            $cek_gambar = postingan::where('id',$id)->first();
        
                            if(!($cek_gambar->gambar_utama == 'none.jpg')){
                                File::delete('images/postingan/'.$cek_gambar->gambar_utama);
                            }

                            $upload = $request->file('gambar_utama')->move(\base_path() ."/public/images/postingan/", $gambar_utama);
                        }else {
                            $gambar_utama = $gambar_lama;
                        }
        
                    }else {
                        $gambar_utama = $gambar_lama;
                    }
                    
                }else {
                    $gambar_utama = $gambar_lama;
                }
        
                $sql = $postingan->where('id',$id)->update([
                    'judul' => $judul,
                    'penulis' => $penulis,
                    'gambar_utama' => $gambar_utama,
                    'tag' => $tag,
                    'konten' => $konten
                ]);
        
                if ($sql) {
                    return redirect('data_postingan')->with('toast_success','Data berhasil diubah');
                }else {
                    return redirect('data_postingan/create')->with('toast_error','Data gagal ditambahkan');
                }
        }else {
            return redirect('data_postingan')->with('toast_error','Terjadi Kesalahan..');
        }
        

        // }else{
        //     return redirect('data_postingan')->with('toast_error', 'Error...');
        // }

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, postingan $postingan,$id)
    {
        
        $cek_posisi = $request->session()->get('posisi');
        $cek_penulis = $request->session()->get('penulis');
        $cek_nim = $request->session()->get('nim');

        if($cek_posisi=='admin') {
            $lanjut = true;
        }else if (($cek_posisi=='bendahara' || $cek_posisi=='anggota') && $cek_penulis=='penulis'){
            $cek = $postingan->join('anggota','anggota.nim','=','postingan.penulis')
            ->where('postingan.id',$id)
            ->where('postingan.penulis',$cek_nim)
            ->count();
            if($cek==1){
                $lanjut=true;
            }else {
                $lanjut=false;
            }
        }else {
            $lanjut=false;
        }

        if($lanjut){
            $ambil = $postingan->where('id',$id)->first();
            if(!($ambil->gambar_utama == 'none.jpg')){
                File::delete('images/postingan/'.$ambil->gambar_utama);
            }
            $delete = $postingan->where('id',$id)->delete();
        }else {
            return redirect('data_postingan')->with('toast_error','terjadi kesalahan...');
        }

        if($delete){
            return redirect('data_postingan')->with('toast_success','Data berhasil Hapus');
        }else {
            return redirect('data_postingan')->with('toast_error','Error...');
        }


    }
}
