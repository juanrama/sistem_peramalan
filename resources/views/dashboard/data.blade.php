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
      <div class="buttons mb-2">
        <a href="/database/akademik/create" class="btn btn-success rounded-pill btn-lg">Input Data Baru</a>
        <form action="{{ route('database.uploadData') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
          @csrf
          <label for="excel-file" class="btn btn-success rounded-pill btn-lg">
            <i class="fa fa-cloud-upload" style="margin-right: 10px"></i>Upload Data Excel
          </label>
          <input id="excel-file" type="file" name="file" style="display:none;" onchange="this.form.submit()">
        </form>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="/database/akademik" method="GET">
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
                <th style="text-align:center;">Action</th>
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
                <td style="text-align:center;">
                  <a href="/database/akademik/{{ $ak->id_mhs }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                  <form action="{{ route('database.destroy', $ak->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah kamu yakin?')">
                      <span data-feather="x-circle"></span>
                    </button>
                  </form></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $akademik->links() }}
        </div>
      </div>
    </section>

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

      <script>
        document.querySelector('.custom-file-upload').addEventListener('click', function() {
        document.querySelector('input[type="file"]').click();
      });
      </script>

      
  </div>
</div>

    
@endsection