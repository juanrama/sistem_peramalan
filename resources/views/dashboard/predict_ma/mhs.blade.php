@extends('dashboard.layouts.main')

@section('container')
<div id="main">
  <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
      <i class="bi bi-justify fs-3"></i>
    </a>
  </header>

  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data IP Mahasiswa Semester 1 - 6</h3>
          <p class="text-subtitle text-muted">
            Berikut ini merupakan data index prestasi mahasiswa dari semester 1 hingga semester 6
          </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
            aria-label="breadcrumb"
            class="breadcrumb-header float-start float-lg-end"
          >
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <form action="/ma/mahasiswa" method="GET">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="filter_mahasiswa">Filter Mahasiswa:</label>
                <input type="text" class="form-control" name="id_mhs" id="filter_mahasiswa" value="{{ old('id_mhs', $mahasiswa_selected) }}">
                <label for="filter_angkatan">Filter Angkatan:</label>
                <select class="form-control" name="angkatan" id="filter_angkatan">
                  <option value="">- Pilih Angkatan -</option>
                  @foreach($angkatan_list as $angkatan1)
                    <option value="{{ $angkatan1 }}" @if($angkatan1 == $angkatan_selected) selected @endif>{{ $angkatan1 }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="filter_prodi">Filter Prodi:</label>
                <select class="form-control" name="prodi" id="filter_prodi">
                  <option value="">- Pilih Prodi -</option>
                  @foreach($prodi_list as $prodi)
                    <option value="{{ $prodi}}" @if($prodi == $prodi_selected) selected @endif>{{ $prodi }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Filter</button>
          </form>
          <table class="table table-striped" id="table1">
            <thead>
              <tr>
                <th>ID Mahasiswa</th>
                <th>Angkatan</th>
                <th>Prodi</th>
                <th>Semester 1</th>
                <th>Semester 2</th>
                <th>Semester 3</th>
                <th>Semester 4</th>
                <th>Semester 5</th>
                <th>Semester 6</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($akademik as $ak)
              <tr>
                <td>{{ $ak -> id_mhs }}</td>
                <td>{{ $ak -> angkatan }}</td>
                <td>{{ $ak -> id_prodi }}</td>
                <td>{{ $ak -> semester_1 }}</td>
                <td>{{ $ak -> semester_2 }}</td>
                <td>{{ $ak -> semester_3 }}</td>
                <td>{{ $ak -> semester_4 }}</td>
                <td>{{ $ak -> semester_5 }}</td>
                <td>{{ $ak -> semester_6 }}</td>
              </tr>
                  
              @endforeach
            </tbody>
          </table>
          {{ $akademik->links() }}
        </div>
      </div>
    </section>
        <div class="card">
          <div class="card-header">Prediksi IPK Mahasiswa</div>

          <div class="card-body">
              <form method="get" action="/ma/mahasiswa/mapred">
                  @csrf

                  <div class="form-group row">
                      <label for="id_mhs" class="col-md-4 col-form-label text-md-right">ID Mahasiswa</label>

                      <div class="col-md-6">
                          <input id="id_mhs" type="text" class="form-control @error('id_mhs') is-invalid @enderror" name="id_mhs" value="{{ old('id_mhs') }}" required autocomplete="id_mhs" autofocus>

                          @error('id_mhs')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="n_periode" class="col-md-4 col-form-label text-md-right">Periode Moving</label>
                    <div class="col-md-6">
                          <input id="n_periode" type="number" class="form-control @error('n_periode') is-invalid @enderror" name="n_periode" value="{{ old('n_periode') }}" step="1" min="1" max="4" required autocomplete="n_periode" autofocus>
                      </div>
                </div>
                <div class="form-group row">
                  <label for="penghalusan" class="col-md-4 col-form-label text-md-right">Tipe Penghalusan</label>
                  <div class="col-md-6">
                      <select class="form-control" name="penghalusan" id="penghalusan">
                          <option value="">Tanpa Penghalusan</option>
                          <option value="Kabupaten">Kabupaten</option>
                          <option value="Jenis Kelamin">Jenis Kelamin</option>
                          <option value="SMA">SMA</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              Tampilkan Prediksi
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
      @if(session()->has('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
      @endif
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      @if (session('success'))
      <script>
        Swal.fire(
          'Selamat!',
          'Data berhasil ditambahkan!',
          'success'
        )
      </script>
      @endif
      @if (session('hapus'))
      <script>
        Swal.fire(
          'Selamat!',
          'Data berhasil dihapus!',
          'success'
        )
      </script>
      @endif
      @if (session('ubah'))
      <script>
        Swal.fire(
          'Selamat!',
          'Data berhasil diubah!',
          'success'
        )
      </script>
      @endif

      @if (session('error_id'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Maaf',
          text: 'Data mahasiswa tidak ditemukan di database',
        })
      </script>
      @endif

      @if (session('error_ipk'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Maaf',
          text: 'IPK mahasiswa bermasalah',
        })
      </script>
      @endif

      
  </div>
</div>

    
@endsection