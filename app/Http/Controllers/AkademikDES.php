<?php

namespace App\Http\Controllers;

use App\DES;
use App\DES_jk;
use App\DES_kab;
use DivisionByZeroError;
use App\Models\Akademik;
use Illuminate\Http\Request;

class AkademikDES extends Controller
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
        return view('dashboard.predict_des.mhs', [
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
            $id_mhs = $request->input('id_mhs');
            $q = $request->input('penghalusan');
            $akademik = Akademik::where('id_mhs', $id_mhs)->first();
            if (!$akademik) {
                    session()->flash('error', 'Mahasiswa dengan ID yang dimasukkan tidak ditemukan.');
                    return redirect('/des/mahasiswa')->with('error_id', 'ID Mahasiswa tidak ditemukan di database.');
                }
            $alpha = $request->input('alpha');
            $nextPeriode = 1;
            if ($q == 'Jenis Kelamin') {
                $q_penghalusan = $akademik -> q_jk;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    1 => $akademik->semester_1,
                    2 => $akademik->semester_2,
                    3 => $akademik->semester_3,
                    4 => $akademik->semester_4,
                    5 => $akademik->semester_5,
                    6 => $akademik->semester_6
                );
                $f = new DES_jk($nilai2, $alpha, $nextPeriode, $q_penghalusan);  
                
                $prediksi_p = [null, $f->ft[2], $f->ft_p[3], $f->ft_p[4], $f->ft_p[5],$f->ft_p[6], $f->ft_next_p[7]];
                $prediksi_n = [null, $f->ft[2], $f->ft[3], $f->ft[4], $f->ft[5], $f->ft[6], $f->ft_next[7]];

                $prediksi_value = [
                    2 => $f->ft[2],
                    3 => $f->ft_p[3],
                    4 => $f->ft_p[4],
                    5 => $f->ft_p[5],
                    6 => $f->ft_p[6]
                ];

                return view('dashboard.predict_des.hasil_p', ['nilai' => json_encode($nilai1),
                'q' => $q, 
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $f, 
                'prediksi_value' => $prediksi_value, 
                'alpha' => $alpha]);
            }
            if ($q == 'Kabupaten') {
                $q_penghalusan = $akademik -> q_kab;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    1 => $akademik->semester_1,
                    2 => $akademik->semester_2,
                    3 => $akademik->semester_3,
                    4 => $akademik->semester_4,
                    5 => $akademik->semester_5,
                    6 => $akademik->semester_6
                );
                $f = new DES_kab($nilai2, $alpha, $nextPeriode, $q_penghalusan);  
                
                $prediksi_p = [null, $f->ft[2], $f->ft_p[3], $f->ft_p[4], $f->ft_p[5],$f->ft_p[6], $f->ft_next_p[7]];
                $prediksi_n = [null, $f->ft[2], $f->ft[3], $f->ft[4], $f->ft[5], $f->ft[6], $f->ft_next[7]];

                $prediksi_value = [
                    2 => $f->ft[2],
                    3 => $f->ft_p[3],
                    4 => $f->ft_p[4],
                    5 => $f->ft_p[5],
                    6 => $f->ft_p[6]
                ];

                return view('dashboard.predict_des.hasil_p', ['nilai' => json_encode($nilai1), 
                'q' => $q,
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $f, 
                'prediksi_value' => $prediksi_value, 
                'alpha' => $alpha]);
            }

            if ($q == 'SMA') {
                $q_penghalusan = $akademik -> q_sma;
                $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik -> semester_6];
                $nilai2 = array(
                    1 => $akademik->semester_1,
                    2 => $akademik->semester_2,
                    3 => $akademik->semester_3,
                    4 => $akademik->semester_4,
                    5 => $akademik->semester_5,
                    6 => $akademik->semester_6
                );
                $f = new DES_kab($nilai2, $alpha, $nextPeriode, $q_penghalusan);  
                
                $prediksi_p = [null, $f->ft[2], $f->ft_p[3], $f->ft_p[4], $f->ft_p[5],$f->ft_p[6], $f->ft_next_p[7]];
                $prediksi_n = [null, $f->ft[2], $f->ft[3], $f->ft[4], $f->ft[5], $f->ft[6], $f->ft_next[7]];

                $prediksi_value = [
                    2 => $f->ft[2],
                    3 => $f->ft_p[3],
                    4 => $f->ft_p[4],
                    5 => $f->ft_p[5],
                    6 => $f->ft_p[6]
                ];

                return view('dashboard.predict_des.hasil_p', ['nilai' => json_encode($nilai1),
                'q' => $q, 
                'akademik' => $akademik, 
                'prediksi_p' => json_encode($prediksi_p),
                'prediksi_n' => json_encode($prediksi_n), 
                'nilai_prediksi' => $f, 
                'prediksi_value' => $prediksi_value, 
                'alpha' => $alpha]);
            }
            
            $nilai1 = [$akademik->semester_1, $akademik->semester_2, $akademik->semester_3, $akademik->semester_4, $akademik->semester_5, $akademik->semester_6];
            $nilai2 = array(
                'Semester 1' => $akademik->semester_1,
                'Semester 2' => $akademik->semester_2,
                'Semester 3' => $akademik->semester_3,
                'Semester 4' => $akademik->semester_4,
                'Semester 5' => $akademik->semester_5,
                'Semester 6' => $akademik->semester_6
            );
            $f = new DES($nilai2, $alpha, $nextPeriode);  
            
            $nilai3 = [null, $f->ft['Semester 2'], $f->ft['Semester 3'], $f->ft['Semester 4'], $f->ft['Semester 5'], $f->ft['Semester 6'], $f->ft_next[0]];

            $prediksi_value = [
                'Semester 2' => $f->ft['Semester 2'],
                'Semester 3' => $f->ft['Semester 3'],
                'Semester 4' => $f->ft['Semester 4'],
                'Semester 5' => $f->ft['Semester 5'],
                'Semester 6' => $f->ft['Semester 6'],
                
            ];

            return view('dashboard.predict_des.hasil', ['nilai' => json_encode($nilai1), 'akademik' => $akademik, 'prediksi' => json_encode($nilai3), 'nilai_prediksi' => $f, 'prediksi_value' => $prediksi_value, 'alpha' => $alpha]);
        }

        catch (DivisionByZeroError $e) {
            // Jika terjadi error pada proses prediksi, kembalikan halaman dengan pesan error
            return redirect('/des/mahasiswa')->with('error_ipk', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akademik $akademik)
    {

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
