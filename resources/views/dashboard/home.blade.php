@extends('dashboard.layouts.main')

@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
              <i class="bi bi-justify fs-3"></i>
            </a>
          </header>
        <div class="main-content container-fluid my-10">
            <div class="page-title">
                <h4 class="text-center mb-3">Selamat Datang, {{ auth() -> user() -> name  }}</h4>
            </div>
            <section class="section">
                <div id="dashboard-content" class="d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('images/analytics.png') }}" alt="Dashboard Admin" style="height: 300px"
                        class="img-fluid">
                    <div class="d-flex justify-content-center align-items-center">
                            <a href="/regresi/mahasiswa"><button class="btn btn-primary rounded-pill mt-4">Menuju Perhitungan Regresi<i
                                        class="badge-circle badge-circle-light-secondary font-medium-1"
                                        data-feather="arrow-right"></i></button></a>
                            <a href="/des/mahasiswa"><button class="btn btn-primary rounded-pill mt-4 ms-2">Menuju Perhitungan DES<i
                                        class="badge-circle badge-circle-light-secondary font-medium-1"
                                        data-feather="arrow-right"></i></button></a>
                            <a href="/ma/mahasiswa"><button class="btn btn-primary rounded-pill mt-4 ms-2">Menuju Perhitungan MA<i
                                            class="badge-circle badge-circle-light-secondary font-medium-1"
                                            data-feather="arrow-right"></i></button></a>            
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/guide"><button class="btn btn-primary rounded-pill mt-4 ms-2">Menuju Petunjuk <i
                                    class="badge-circle badge-circle-light-secondary font-medium-1"
                                    data-feather="arrow-right"></i></button></a>
                    </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Maaf',
          text: 'User dilarang mengakses',
        })
      </script>
      @endif

      @if (session('success_wajah'))
      <script>
        Swal.fire(
          'Selamat!',
          'Autentikasi Wajah Telah Berhasil!',
          'success'
        )
      </script>
      @endif
@endsection
