<?php

namespace App\Http\Controllers;

use App\FTM;
use App\FTM_jk;
use App\FTM_kab;
use Exception;
use App\Models\Akademik;
use DivisionByZeroError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAkademikRequest;
use App\Http\Requests\UpdateAkademikRequest;

class AkademikController extends Controller
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
        return view('dashboard.predict.mhs', [
            'akademik' => $akademik,
            'angkatan_list' => $angkatan_list,
            'prodi_list' => $prodi_list,
            'angkatan_selected' => $angkatan_selected,
            'prodi_selected' => $prodi_selected,
            'mahasiswa_selected' => $mahasiswa_selected
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $q = $request->input('penghalusan');
            if($q == 'Jenis Kelamin'){
                $id_mhs = $request->input('id_mhs');
                $akademik = Akademik::where('id_mhs', $id_mhs)->first();
                if (!$akademik) {
                    session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                    return redirect('/regresi/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
                }
                $q_penghalusan = $akademik -> q_jk;
                $nextPeriode = 1;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new FTM_jk($nilai2, $nextPeriode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->fx['Semester 1'], $prediksi->fx['Semester 2'], $prediksi->fx['Semester 3'], $prediksi->fx['Semester 4'], $prediksi->fx['Semester 5'], $prediksi->fx['Semester 6'],  $prediksi->next_fx['Semester 7']];

                $prediksi_p =[$prediksi->fx['Semester 1'], $prediksi->fx_p['Semester 2'], $prediksi->fx_p['Semester 3'], $prediksi->fx_p['Semester 4'], $prediksi->fx_p['Semester 5'], $prediksi->fx_p['Semester 6'], $prediksi->next_fx_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->fx_p['Semester 1'],
                    'Semester 2' => $prediksi->fx_p['Semester 2'],
                    'Semester 3' => $prediksi->fx_p['Semester 3'],
                    'Semester 4' => $prediksi->fx_p['Semester 4'],
                    'Semester 5' => $prediksi->fx_p['Semester 5'],
                    'Semester 6' => $prediksi->fx_p['Semester 6'],
                ];

                return view('dashboard.predict.hasil_p', ['nilai' => json_encode($nilai1),
                'q' => $q, 
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value,
                'selisih' => $prediksi->selisih['Semester 2']]);
            }

            if($q == 'Kabupaten'){
                $id_mhs = $request->input('id_mhs');
                $akademik = Akademik::where('id_mhs', $id_mhs)->first();
                if (!$akademik) {
                    session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                    return redirect('/regresi/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
                }
                $q_penghalusan = $akademik -> q_kab;
                $nextPeriode = 1;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new FTM_kab($nilai2, $nextPeriode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->fx['Semester 1'], $prediksi->fx['Semester 2'], $prediksi->fx['Semester 3'], $prediksi->fx['Semester 4'], $prediksi->fx['Semester 5'], $prediksi->fx['Semester 6'],  $prediksi->next_fx['Semester 7']];

                $prediksi_p =[$prediksi->fx['Semester 1'], $prediksi->fx_p['Semester 2'], $prediksi->fx_p['Semester 3'], $prediksi->fx_p['Semester 4'], $prediksi->fx_p['Semester 5'], $prediksi->fx_p['Semester 6'], $prediksi->next_fx_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->fx_p['Semester 1'],
                    'Semester 2' => $prediksi->fx_p['Semester 2'],
                    'Semester 3' => $prediksi->fx_p['Semester 3'],
                    'Semester 4' => $prediksi->fx_p['Semester 4'],
                    'Semester 5' => $prediksi->fx_p['Semester 5'],
                    'Semester 6' => $prediksi->fx_p['Semester 6'],
                ];

                return view('dashboard.predict.hasil_p', ['nilai' => json_encode($nilai1),
                'q' => $q, 
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value]);
            }

            if($q == 'SMA'){
                $id_mhs = $request->input('id_mhs');
                $akademik = Akademik::where('id_mhs', $id_mhs)->first();
                if (!$akademik) {
                    session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                    return redirect('/regresi/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
                }
                $q_penghalusan = $akademik -> q_sma;
                $nextPeriode = 1;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new FTM_kab($nilai2, $nextPeriode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->fx['Semester 1'], $prediksi->fx['Semester 2'], $prediksi->fx['Semester 3'], $prediksi->fx['Semester 4'], $prediksi->fx['Semester 5'], $prediksi->fx['Semester 6'],  $prediksi->next_fx['Semester 7']];

                $prediksi_p =[$prediksi->fx['Semester 1'], $prediksi->fx_p['Semester 2'], $prediksi->fx_p['Semester 3'], $prediksi->fx_p['Semester 4'], $prediksi->fx_p['Semester 5'], $prediksi->fx_p['Semester 6'], $prediksi->next_fx_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->fx_p['Semester 1'],
                    'Semester 2' => $prediksi->fx_p['Semester 2'],
                    'Semester 3' => $prediksi->fx_p['Semester 3'],
                    'Semester 4' => $prediksi->fx_p['Semester 4'],
                    'Semester 5' => $prediksi->fx_p['Semester 5'],
                    'Semester 6' => $prediksi->fx_p['Semester 6'],
                ];

                return view('dashboard.predict.hasil_p', ['nilai' => json_encode($nilai1),
                'q' => $q, 
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value,
                ]);
            }
            $id_mhs = $request->input('id_mhs');
            $akademik = Akademik::where('id_mhs', $id_mhs)->first();
            if (!$akademik) {
                session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                return redirect('/regresi/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
            }
                
            $nextPeriode = 1;
            $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
            $nilai2 = array(
                'Semester 1' => $akademik->semester_1,
                'Semester 2' => $akademik->semester_2,
                'Semester 3' => $akademik->semester_3,
                'Semester 4' => $akademik->semester_4,
                'Semester 5' => $akademik->semester_5,
                'Semester 6' => $akademik->semester_6,
            );
            $prediksi = new FTM($nilai2, $nextPeriode);  
            
            $nilai3 = [$prediksi->fx['Semester 1'], $prediksi->fx['Semester 2'], $prediksi->fx['Semester 3'], $prediksi->fx['Semester 4'], $prediksi->fx['Semester 5'], $prediksi->fx['Semester 6'], $prediksi->next_fx['Semester 7']];

            $prediksi_value = [
                'Semester 1' => $prediksi->fx['Semester 1'],
                'Semester 2' => $prediksi->fx['Semester 2'],
                'Semester 3' => $prediksi->fx['Semester 3'],
                'Semester 4' => $prediksi->fx['Semester 4'],
                'Semester 5' => $prediksi->fx['Semester 5'],
                'Semester 6' => $prediksi->fx['Semester 6'],
            ];

            return view('dashboard.predict.hasil', ['nilai' => json_encode($nilai1), 'akademik' => $akademik, 'prediksi' => json_encode($nilai3), 'nilai_prediksi' => $prediksi, 'prediksi_value' => $prediksi_value]);
        }

        catch (DivisionByZeroError $e) {
            // Jika terjadi error pada proses prediksi, kembalikan halaman dengan pesan error
            return redirect('/regresi/mahasiswa')->with('error_ipk', 'Terjadi kesalahan: '.$e->getMessage());
        }
            
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_mhs)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akademik $akademik, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
