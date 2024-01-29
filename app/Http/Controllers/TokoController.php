<?php

namespace App\Http\Controllers;

use App\DataTables\TokoModelDataTable;
use App\Models\LogModel;
use App\Models\SettingModel;
use App\Models\TokoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TokoModelDataTable $dataTable)
    {
        return $dataTable->render('toko.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $file = $request->file('logo_toko');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(Storage::path('public/img'), $filename);
        $data = $request->except(['_token', 'logo_toko', 'default_toko']);
        $data['logo_toko'] = $filename;
        $id = TokoModel::create($data)->id;
        if ($request->default_toko) {
            SettingModel::firstOrNew(['toko_id' => $id])->save();
        }

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menambahkan toko baru nama : ' . $request->nama_toko
        ]);

        return redirect()->route('toko.create')->with('success', 'Data berhasil disimpan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except(['_token', '_method', 'logo_toko', 'defaultToko']);
        $toko = TokoModel::findOrFail($id);
        if ($request->hasFile('logo_toko')) {
            $file = $request->file('logo_toko');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(Storage::path('public/img'), $filename);
            $data['logo_toko'] = $filename;
            Storage::delete('public/img/' . $toko->logo_toko);
        }
        $toko->update($data);

        if ($request->defaultToko) {
            SettingModel::find(1)->update(['toko_id' => $id]);
        }

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Mengubah toko nama : ' . $request->nama_toko
        ]);

        return redirect()->route('toko.create')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toko = TokoModel::findOrFail($id);
        Storage::delete('public/img/' . $toko->logo_toko);
        $toko->setting()->delete();
        $toko->delete();

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menghapus toko nama : ' . $toko->nama_toko
        ]);


        return redirect()->route('toko.create')->with('success', 'Data berhasil dihapus.');
    }
}
