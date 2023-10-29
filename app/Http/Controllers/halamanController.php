<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil data nya serta urutkan dari judul yg asc/terbaru
       $data = halaman::orderBy('judul', 'asc')->get(); 
       return view('dashboard.halaman.index')->with('data' , $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.halaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('isi', $request->isi);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ],[
            'judul.required' => 'Judul wajib diisi',
            'isi.required' => 'Isian wajib diisi',
        ]
    );

    $data = [
        'judul' => $request->judul,
        'isi' => $request->isi
    ];

    halaman::create($data);

    return redirect()->route('halaman.index')->with('success', 'Berhasil menambahkan data');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = halaman::where('id', $id)->first();
        return view('dashboard.halaman.edit')->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ],[
            'judul.required' => 'Judul wajib diisi',
            'isi.required' => 'Isian wajib diisi',
        ]
    );

    $data = [
        'judul' => $request->judul,
        'isi' => $request->isi
    ];

    halaman::where('id', $id)->update($data);

    return redirect()->route('halaman.index')->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        halaman::where('id', $id)->delete();
        return redirect()->route('halaman.index')->with('success', 'Berhasil Melakukan Delete Data');
    }
}
