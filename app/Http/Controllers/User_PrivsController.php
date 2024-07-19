<?php

namespace App\Http\Controllers;

use App\Models\User_Privs;
use App\Models\Roles;
use App\Models\Modules;
use Illuminate\Http\Request;

class User_PrivsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman master user_priv
        $user_privList = User_Privs::with(['role', 'module'])->get();
        $roleList = Roles::all();
        $moduleList = Modules::all();
        // dd($user_privList);
        return view('user_privs.dashboardUser_Privs', ['roleList' => $roleList, 'moduleList' => $moduleList]);
    }

    // Api Data User_Privs 
    public function getData()
    {
        // Mengambil data user_priv dengan relasi role dan module
        $user_privList = User_Privs::with(['role', 'module'])->get()->map(function ($user_priv) {
            return [
                'id' => $user_priv->id,
                'keterangan' => $user_priv->role->keterangan,  
                'nama_module' => $user_priv->module->nama_module,  
                'role_id' => $user_priv->module->role_id,  
                'module_id' => $user_priv->module->module_id,  
                'aksi' => '
                    <button class="btn btn-primary btn-sm edit-btn" data-id="' . $user_priv->id . '">
                        <ion-icon name="create-outline"></ion-icon>
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="' . $user_priv->id . '">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>'
            ];
        });
        return response()->json($user_privList);
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
    public function storeOrUpdate(Request $request, $id = NULL)
    {
        // Validasi data yang masuk
        $request->validate([
            'id' => 'nullable|exists:user__privs,id',
            'role_id' => 'required|integer',
            'module_id' => 'required|integer'
        ]);
        if ($request->filled('id')) {
            // Jika ID ada, update item yang sudah ada
            $item = User_Privs::find($request->id);
            if ($item) {
                $item->role_id = $request->role_id;
                $item->module_id = $request->module_id;
                $item->save();
                return redirect()->back()->with('success', 'Data berhasil diupdate.');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
        } else {
            // Jika ID tidak ada, buat item baru
            $item = new User_Privs;
            $item->role_id = $request->role_id;
            $item->module_id = $request->module_id;
            $item->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        }
    }
    
    

    public function getModuleById($id)
    {
        $user_priv = User_Privs::find($id);
        return response()->json($user_priv);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = User_Privs::find($id);
        
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }    
}
