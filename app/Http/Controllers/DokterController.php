<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dimana role adalah dokter
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'no_ktp' => 'required|numeric|digits_between:10,20',
        'no_hp' => 'required|numeric|digits_between:10,15',
        'alamat' => 'required|string',
        'id_poli' => 'required|exists:poli,id',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'no_ktp' => $request->no_ktp,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'id_poli' => $request->id_poli,
        'role' => 'dokter',
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('dokter.index')->with([
        'message' => 'Data dokter berhasil ditambahkan!',
        'type' => 'success'
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     * $dokter adalah route model binding jadi yang harus nya kita buat
     * $dokter = User::findOrFail($id); kita bisa membuat menjadi parameter, 
     * namun jika menggunakan cara tersebut kita route nya tidak bisa admin/dokter{id}/edit namun 
     * seperi admin/dokter/{dokter}/edit
     */

public function update(Request $request, User $dokter)
{
    // ✅ Validasi input
    $data = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $dokter->id,
        'no_hp' => 'required|string|max:15',
        'id_poli' => 'required|exists:poli,id',
        'email' => 'required|string|email|unique:users,email,' . $dokter->id,
        'password' => 'nullable|string|min:6', // hanya jika diubah
    ]);

    // ✅ Jika password kosong, jangan ubah
    if (empty($data['password'])) {
        unset($data['password']);
    } else {
        $data['password'] = Hash::make($data['password']);
    }

    // ✅ Update data ke database
    $dokter->update($data);

    return redirect()->route('dokter.index')
        ->with('message', 'Data Dokter Berhasil diubah')
        ->with('type', 'success');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')
            ->with('message', 'Data Dokter Berhasil dihapus')
            ->with('type', 'success');
    }
}