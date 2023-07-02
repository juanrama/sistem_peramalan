@extends('dashboard.layouts.main')

@section('container')
<div id="main">
  <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
      <i class="bi bi-justify fs-3"></i>
    </a>
  </header>
    <div>
        <ol>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/halaman-utama.jpg') }}" alt="Dashboard Admin" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Halaman Utama menyajikan menu ke petunjuk penggunaan dan memulai perhitungan. Petunjuk penggunaan menampilkan bagaimana cara menggunakan aplikasi dan memulai perhitungan melanjutkan step-step ke perhitungan.</p>
          </li>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/perhitungan.jpg') }}" alt="Kriteria" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Pada menu perhitungan terdapat 3 opsi metode permalan yang dapat dipilih. Masing-masih metode peramalan memiliki kelebihan dan kekurangan masing-masing</p>
          </li>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/filter.jpg') }}" alt="Subkriteria" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Pada halaman metode peramalan, user dapat melakukan filter maupun pencarian id mahasiswa pada kolom ID Mahasiswa, Angkatan, Prodi.</p>
          </li>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/prediksi.jpg') }}" alt="Alternatif" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Untuk melakukan peramalan, user dapat mengisikan beberapa parameter di bagian bawah halaman metode peramalan lalu tekan tombol 'Tampilkan Prediksi'</p>
          </li>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/hasil-prediksi.jpg') }}" alt="Nilai Bobot" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Apabila user sudah menekan tombol 'Tampilkan Prediksi', maka user akan diarahkan menuju halaman hasil prediksi yang berisikan tabel analisis dan grafik prediksi</p>
          </li>
          <div class="d-flex justify-content-center align-items-center pt-3 pb-2" style="padding-right: 2rem;">
            <img src="{{ asset('images/petunjuk-rama/ganti-prediksi.jpg') }}" alt="SAW" style="max-height: 300px; border: 2px solid rgb(69, 69, 69);" class="img-fluid">
          </div>
          <li class="pb-2">
            <p>Untuk melakukan prediksi lagi, user bisa mengubah parameter pada bagian atas halaman dan menekan tombol 'Tampilkan Prediksi'</p>
          </li>
        </ol>
      </div>
</div>

    
@endsection