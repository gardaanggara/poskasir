<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman master modules
        $moduleList = Modules::all();
        // dd($moduleList);
        return view('modules.dashboardModules', $moduleList);
    }

    // Api Data Modules 
    public function getData()
    {
        // Mengambil data module
        $moduleList = Modules::all()->map(function ($module) {
            $module->aksi = '
                <button class="btn btn-primary btn-sm edit-btn" data-id="' . $module->id . '">
                    <ion-icon name="create-outline"></ion-icon>
                </button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="' . $module->id . '">
                    <ion-icon name="trash-outline"></ion-icon>
                </button>';
            return $module;
        });
        return response()->json($moduleList);
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
            'id' => 'nullable|exists:modules,id',
            'NamaModule' => 'required|string',
            'active' => 'required|string'
        ]);
        if ($request->filled('id')) {
            // Jika ID ada, update item yang sudah ada
            $item = Modules::find($request->id);
            if ($item) {
                $item->nama_module = $request->NamaModule;
                $item->active = $request->active;
                $item->save();
                return redirect()->back()->with('success', 'Data berhasil diupdate.');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
        } else {
            // Jika ID tidak ada, buat item baru
            $item = new Modules;
            $item->nama_module = $request->NamaModule;
            $item->active = $request->active;
            $item->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        }
    }

    public function getModuleById($id)
    {
        $module = Modules::find($id);
        return response()->json($module);
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
        $item = Modules::find($id);
        
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }    
}
