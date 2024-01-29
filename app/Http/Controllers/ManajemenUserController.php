<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\LogModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('manage-user.index');
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
        User::create($request->all());

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menambahkan user baru username : ' . $request->username . ' role : ' . $request->role
        ]);
        return redirect()->route('manajemen-user.index')
            ->with('success', 'User created successfully.');
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
        User::find($id)->update($request->all());

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Mengubah user username : ' . $request->username . ' role : ' . $request->role
        ]);

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menghapus user username : ' . $user->username . ' role : ' . $user->role
        ]);

        User::destroy($id);

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User deleted successfully');
    }
}
