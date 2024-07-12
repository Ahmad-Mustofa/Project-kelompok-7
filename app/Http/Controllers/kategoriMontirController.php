<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriMontir;

class kategoriMontirController extends Controller
{
    public function index(){
        // fitur pagination
        $max_view = 3;

        // fitur pencarian
        if(request('search')) {
            $kategori_montir = KategoriMontir::where('nama', 'like', '%'.request('search').'%')->paginate($max_view)->withQueryString();
        }else {
            $kategori_montir = KategoriMontir::orderBy('nama')->paginate($max_view);
        }

        return view('dashboard.kategori_montir.index', compact('kategori_montir'));
    }

    public function create()
        {
            return view('dashboard.kategori_montir.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
        ],
        [
            'nama.required' => 'Nama kategori_montir Wajib Diisi',
            'nama.min' => 'Nama kategori_montir Minimal 3 Karakter',
            'nama.max' => 'Nama Jabtan Maximal 50 Karakter',
        ]);

        $data = [
            'nama' => $request->input('nama'),
        ];

        KategoriMontir::create($data);
        return redirect()->route('kategori_montir.create')->with('success', 'berhasil simpan data');

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
    public function edit($id)
    {
        $kategori_montir = KategoriMontir::findOrFail($id);
        return view('dashboard.kategori_montir.edit', compact('kategori_montir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
        ],
        [
            'nama.required' => 'Nama kategori_montir Wajib Diisi',
            'nama.min' => 'Nama kategori_montir Minimal 3 Karakter',
            'nama.max' => 'Nama Jabtan Maximal 50 Karakter',
        ]);

        $data = [
            'nama' => $request->input('nama'),
        ];

        $kategori_montir = KategoriMontir::findOrFail($id);
        $kategori_montir->update($data);
        return redirect()->route('kategori_montir.edit', $kategori_montir->id)->with('success', 'Berhasil mengubah data!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori_montir = KategoriMontir::findOrFail($id);
        $kategori_montir->delete();
        return redirect('/dashboard/kategori_montir')->with('success', 'Berhasil menghapus data!');
    }
}
