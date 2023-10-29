<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update(Request $request)
    {

        // validasi
        $request->validate([
            'foto' => 'mimes:jpeg,jpg,png,gif',
            '_email' => 'required|email:dns'
        ],[
            '_foto.mimes' => 'Foto Yg dimasukan hanya boleh berextensi JPEG, JPG, PNG dan GIF',
            '_email.required' => 'Email Wajib Diisi',
            '_email.email' => 'Format Email Yg dimasukan salah'
        ]);

        // jika foto yg mau diinsert
        if($request->hasFile('_foto'))
        {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            // memberikan nama foto baru dari kombinasi dari waktu skrng dgn extensi nya
            $foto_baru = date('ymdhis') . " .$foto_ekstensi";
            //kirimkan data foto kedlm folder(foto) yg ingin kita letakan ddlm nya file ($foto_baru) NOTE: ini akan langusng mbuat nama folder dan file di public nya
            $foto_file->move(public_path('foto') , $foto_baru); 

            // kalau ada update foto
            $foto_lama = get_meta_value('_foto');
            File::delete(public_path('foto') . "/" . $foto_lama);

            // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_foto'], ['meta_value' => $foto_baru]);

        }
           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_email'], ['meta_value' => $request->_email]);
            
           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_kota'], ['meta_value' => $request->_kota]);

           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_provinsi'], ['meta_value' => $request->_provinsi]);

           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_nohp'], ['meta_value' => $request->_nohp]);

           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_facebook'], ['meta_value' => $request->_facebook]);

           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_twitter'], ['meta_value' => $request->_twitter]);
            
           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_linkedin'], ['meta_value' => $request->_linkedin]);

           // kalau sudah jalankan dibawah ini
            metadata::updateOrCreate(['meta_key' => '_github'], ['meta_value' => $request->_github]);


            return redirect()->route('profile.index')->with('success' , 'berhasil update data file');
    }

}
