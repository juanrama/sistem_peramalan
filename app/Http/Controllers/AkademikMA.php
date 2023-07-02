<?php

namespace App\Http\Controllers;

use App\MA;
use App\MA_jk;
use App\MA_kab;
use App\Models\Akademik;
use DivisionByZeroError;
use Illuminate\Http\Request;

class AkademikMA extends Controller
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
        return view('dashboard.predict_ma.mhs', [
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $q = $request->input('penghalusan');
            $id_mhs = $request->input('id_mhs');
            $akademik = Akademik::where('id_mhs', $id_mhs)->first();
            if (!$akademik) {
                session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                return redirect('/ma/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
            }
            if($q == 'Jenis Kelamin'){
                $n_periode = $request -> input('n_periode');
                $nextPeriode = 1;
                $q_penghalusan = $akademik -> q_jk;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new MA_jk($nilai2, $nextPeriode, $n_periode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->ft['Semester 1'], 
                $prediksi->ft['Semester 2'], 
                $prediksi->ft['Semester 3'], 
                $prediksi->ft['Semester 4'], 
                $prediksi->ft['Semester 5'],
                $prediksi->ft['Semester 6'], 
                $prediksi->next_ft['Semester 7']];
                
                $prediksi_p = [$prediksi->ft_p['Semester 1'], 
                $prediksi->ft_p['Semester 2'], 
                $prediksi->ft_p['Semester 3'], 
                $prediksi->ft_p['Semester 4'], 
                $prediksi->ft_p['Semester 5'],
                $prediksi->ft_p['Semester 6'],  
                $prediksi->next_ft_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->ft_p['Semester 1'],
                    'Semester 2' => $prediksi->ft_p['Semester 2'],
                    'Semester 3' => $prediksi->ft_p['Semester 3'],
                    'Semester 4' => $prediksi->ft_p['Semester 4'],
                    'Semester 5' => $prediksi->ft_p['Semester 5'],
                    'Semester 6' => $prediksi->ft_p['Semester 6'],
                ];

                return view('dashboard.predict_ma.hasil_p', ['nilai' => json_encode($nilai1), 
                'akademik' => $akademik, 
                'q' => $q,
                'prediksi_n' => json_encode($prediksi_n),
                'prediksi_p' => json_encode($prediksi_p),
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value, 
                'n_periode' => $n_periode]);
            }
            if($q == 'Kabupaten'){
                $n_periode = $request -> input('n_periode');
                $nextPeriode = 1;
                $q_penghalusan = $akademik -> q_kab;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new MA_kab($nilai2, $nextPeriode, $n_periode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->ft['Semester 1'], 
                $prediksi->ft['Semester 2'], 
                $prediksi->ft['Semester 3'], 
                $prediksi->ft['Semester 4'], 
                $prediksi->ft['Semester 5'],
                $prediksi->ft['Semester 6'], 
                $prediksi->next_ft['Semester 7']];
                
                $prediksi_p = [$prediksi->ft_p['Semester 1'], 
                $prediksi->ft_p['Semester 2'], 
                $prediksi->ft_p['Semester 3'], 
                $prediksi->ft_p['Semester 4'], 
                $prediksi->ft_p['Semester 5'],
                $prediksi->ft_p['Semester 6'],  
                $prediksi->next_ft_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->ft_p['Semester 1'],
                    'Semester 2' => $prediksi->ft_p['Semester 2'],
                    'Semester 3' => $prediksi->ft_p['Semester 3'],
                    'Semester 4' => $prediksi->ft_p['Semester 4'],
                    'Semester 5' => $prediksi->ft_p['Semester 5'],
                    'Semester 6' => $prediksi->ft_p['Semester 6'],
                ];


                return view('dashboard.predict_ma.hasil_p', ['nilai' => json_encode($nilai1), 
                'akademik' => $akademik, 
                'q' => $q,
                'prediksi_n' => json_encode($prediksi_n),
                'prediksi_p' => json_encode($prediksi_p),
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value, 
                'n_periode' => $n_periode]);
            }

            if($q == 'SMA'){
                $n_periode = $request -> input('n_periode');
                $nextPeriode = 1;
                $q_penghalusan = $akademik -> q_sma;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
                $nilai2 = array(
                    'Semester 1' => $akademik->semester_1,
                    'Semester 2' => $akademik->semester_2,
                    'Semester 3' => $akademik->semester_3,
                    'Semester 4' => $akademik->semester_4,
                    'Semester 5' => $akademik->semester_5,
                    'Semester 6' => $akademik->semester_6
                );
                $prediksi = new MA_kab($nilai2, $nextPeriode, $n_periode, $q_penghalusan);  
                
                $prediksi_n = [$prediksi->ft['Semester 1'], 
                $prediksi->ft['Semester 2'], 
                $prediksi->ft['Semester 3'], 
                $prediksi->ft['Semester 4'], 
                $prediksi->ft['Semester 5'],
                $prediksi->ft['Semester 6'], 
                $prediksi->next_ft['Semester 7']];
                
                $prediksi_p = [$prediksi->ft_p['Semester 1'], 
                $prediksi->ft_p['Semester 2'], 
                $prediksi->ft_p['Semester 3'], 
                $prediksi->ft_p['Semester 4'], 
                $prediksi->ft_p['Semester 5'],
                $prediksi->ft_p['Semester 6'],  
                $prediksi->next_ft_p['Semester 7']];

                $prediksi_value = [
                    'Semester 1' => $prediksi->ft_p['Semester 1'],
                    'Semester 2' => $prediksi->ft_p['Semester 2'],
                    'Semester 3' => $prediksi->ft_p['Semester 3'],
                    'Semester 4' => $prediksi->ft_p['Semester 4'],
                    'Semester 5' => $prediksi->ft_p['Semester 5'],
                    'Semester 6' => $prediksi->ft_p['Semester 6'],
                ];


                return view('dashboard.predict_ma.hasil_p', ['nilai' => json_encode($nilai1), 
                'akademik' => $akademik, 
                'q' => $q,
                'prediksi_n' => json_encode($prediksi_n),
                'prediksi_p' => json_encode($prediksi_p),
                'nilai_prediksi' => $prediksi, 
                'prediksi_value' => $prediksi_value, 
                'n_periode' => $n_periode]);
            }
            
            
            $n_periode = $request -> input('n_periode');
            $nextPeriode = 1;
            $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
            $nilai2 = array(
                'Semester 1' => $akademik->semester_1,
                'Semester 2' => $akademik->semester_2,
                'Semester 3' => $akademik->semester_3,
                'Semester 4' => $akademik->semester_4,
                'Semester 5' => $akademik->semester_5,
                'Semester 6' => $akademik->semester_6
            );
            $prediksi = new MA($nilai2, $nextPeriode, $n_periode);  
            
            $nilai3 = [$prediksi->ft['Semester 1'], $prediksi->ft['Semester 2'], $prediksi->ft['Semester 3'], $prediksi->ft['Semester 4'], $prediksi->ft['Semester 5'], $prediksi->ft['Semester 6'], $prediksi->next_ft['Semester 7']];

            $prediksi_value = [
                'Semester 1' => $prediksi->ft['Semester 1'],
                'Semester 2' => $prediksi->ft['Semester 2'],
                'Semester 3' => $prediksi->ft['Semester 3'],
                'Semester 4' => $prediksi->ft['Semester 4'],
                'Semester 5' => $prediksi->ft['Semester 5'],
                'Semester 6' => $prediksi->ft['Semester 6']
            ];

            return view('dashboard.predict_ma.hasil', ['nilai' => json_encode($nilai1), 'akademik' => $akademik, 'prediksi' => json_encode($nilai3), 'nilai_prediksi' => $prediksi, 'prediksi_value' => $prediksi_value, 'n_periode' => $n_periode]);
        }

        catch (DivisionByZeroError $e) {
            // Jika terjadi error pada proses prediksi, kembalikan halaman dengan pesan error
            return redirect('/ma/mahasiswa')->with('error_ipk', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akademik $akademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akademik $akademik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akademik $akademik)
    {
        //
    }
}
