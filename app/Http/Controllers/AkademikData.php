<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use Illuminate\Http\Request;
use App\Imports\AkademikImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class AkademikData extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $akademik = Akademik::query();
        $angkatan_selected = $request->input('angkatan');
        $prodi_selected = $request->input('prodi');
        $mahasiswa_selected = $request->input('id_mhs');
        if ($angkatan_selected) {
            $akademik->where('angkatan', $angkatan_selected);
        }
        if ($prodi_selected) {
            $akademik->where('id_prodi', $prodi_selected);
        }
        if ($mahasiswa_selected) {
            $akademik->where('id_mhs', $mahasiswa_selected);
        }
        $akademik = $akademik->paginate(10)->withQueryString();

        // Ambil data angkatan dan prodi untuk dropdown filter
        $angkatan_list = Akademik::distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        $prodi_list = Akademik::distinct()->orderBy('id_prodi', 'desc')->pluck('id_prodi');
        return view('dashboard.data', [
            'akademik' => $akademik,
            'angkatan_list' => $angkatan_list,
            'prodi_list' => $prodi_list,
            'angkatan_selected' => $angkatan_selected,
            'prodi_selected' => $prodi_selected,
            'mahasiswa_selected' => $mahasiswa_selected,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $q_kab = Akademik::distinct('q_kab')->pluck('q_kab');
        $q_sma = Akademik::distinct('q_sma')->pluck('q_sma');
        $q_jk = Akademik::distinct('q_jk')->pluck('q_jk');
        return view('dashboard.create', [
            'q_kab' => $q_kab,
            'q_sma' => $q_sma,
            'q_jk' => $q_jk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'id_mhs' => 'required|max:6|min:6|unique:akademiks',
            'angkatan' => 'required|integer|between:2016,2020',
            'id_prodi' => 'required|integer',
            'sma' => 'required|integer',
            'jk' => 'required|integer',
            'kabupaten' => 'required|integer',
            'q_sma' => 'required|integer|between:0,4',
            'q_kab' => 'required|integer|between:0,4',
            'q_jk' => 'required|integer|between:0,2',
            'semester_1' => 'required|between:0,4.00',
            'semester_2' => 'required|between:0,4.00',
            'semester_3' => 'required|between:0,4.00',
            'semester_4' => 'required|between:0,4.00',
            'semester_5' => 'required|between:0,4.00',
            'semester_6' => 'required|between:0,4.00',
        ]);

        Akademik::create($validatedData);

        return redirect('/database/akademik')->with('success', 'Post baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Akademik $akademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_mhs)
    {
        $akademik = Akademik::where('id_mhs', $id_mhs) -> first();
        $q_kab = Akademik::distinct('q_kab')->pluck('q_kab');
        $q_sma = Akademik::distinct('q_sma')->pluck('q_sma');
        $q_jk = Akademik::distinct('q_jk')->pluck('q_jk');
        return view('dashboard.edit', [
            'akademik' => $akademik,
            'q_kab' => $q_kab,
            'q_sma' => $q_sma,
            'q_jk' => $q_jk,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'angkatan' => 'required|integer|between:2016,2020',
            'id_prodi' => 'required|integer',
            'sma' => 'required|integer',
            'jk' => 'required|integer',
            'kabupaten' => 'required|integer',
            'q_sma' => 'required|integer|between:0,4',
            'q_kab' => 'required|integer|between:0,4',
            'q_jk' => 'required|integer|between:0,2',
            'semester_1' => 'required|between:0,4.00',
            'semester_2' => 'required|between:0,4.00',
            'semester_3' => 'required|between:0,4.00',
            'semester_4' => 'required|between:0,4.00',
            'semester_5' => 'required|between:0,4.00',
            'semester_6' => 'required|between:0,4.00',
        ];

        $validatedData = $request->validate($rule);

        Akademik::where('id', $id) ->update($validatedData);
        return redirect('/database/akademik')->with('ubah', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $akademik = Akademik::findOrFail($id);
    $akademik->delete();

    return redirect('/database/akademik')->with('hapus', 'Data mahasiswa berhasil dihapus');
    }

    public function uploadData(Request $request)
    {
        Excel::import(new AkademikImport, $request->file);

        return redirect()->route('database.index')->with('success', 'User Imported Successfully');
    }

    public function deleteAllData()
    {
        $akademik = Akademik::all();
        $akademik -> delete();
        return redirect('/database/akademik')->with('hapus', 'Data mahasiswa berhasil dihapus');
    }

}
