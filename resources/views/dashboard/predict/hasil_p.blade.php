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
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
            aria-label="breadcrumb"
            class="breadcrumb-header float-start float-lg-end"
          >
          </nav>
        </div>
      </div>
    </div>
        <div class="card">
          <div class="card-header">Prediksi IPK Mahasiswa</div>

          <div class="card-body">
              <form method="get" action="/regresi/mahasiswa/regpred">
                  @csrf

                  <div class="form-group row">
                      <label for="id_mhs" class="col-md-4 col-form-label text-md-right">ID Mahasiswa</label>

                      <div class="col-md-6">
                          <input id="id_mhs" type="text" class="form-control @error('id_mhs') is-invalid @enderror" name="id_mhs" value="{{ old('id_mhs', $akademik->id_mhs) }}" required autocomplete="id_mhs" autofocus>

                          @error('id_mhs')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                    <div class="form-group row">
                        <label for="penghalusan" class="col-md-4 col-form-label text-md-right">Tipe Penghalusan</label>
                        <div class="col-md-6">
                            <select class="form-control" name="penghalusan" id="penghalusan">
                                <option value="" @if("" == $q) selected @endif>Tanpa Penghalusan</option>
                                <option value="Kabupaten" @if("Kabupaten" == $q) selected @endif>Kabupaten</option>
                                <option value="Jenis Kelamin" @if("Jenis Kelamin" == $q) selected @endif>Jenis Kelamin</option>
                                <option value="SMA" @if("SMA" == $q) selected @endif>SMA</option>
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
      <div class="row" id="table-borderless">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Data Mahasiswa</h4>
            </div>
            <div class="card-content">
              <!-- table with no border -->
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                      <tr>
                      </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td>ID Mahasiswa</td>
                            <td>{{ $akademik->id_mhs }}</td>
                        </tr>
                        <tr>
                            <td>Angkatan</td>
                            <td>{{ $akademik->angkatan }}</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>{{ $akademik->id_prodi }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            @if ($akademik->jk == 1)
                                <td>Laki - Laki</td>
                            @else
                                <td>Perempuan</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Kabupaten</td>
                            <td>{{ $akademik->kabupaten }}</td>
                        </tr>
                        <tr>
                            <td>SMA</td>
                            <td>{{ $akademik->sma }}</td>
                        </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="row" id="table-borderless">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Tabel Analisis</h4>
            </div>
            <div class="card-content">
              <!-- table with no border -->
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <thead>
                    <tr>
                        <th>Jenis Penghalusan</th>
                    </tr>
                    <tr>
                        <td>{{ $q }}</td>
                    </tr>
                    <tr>
                        <tr>
                            <th>Semester</th>
                            <th>Y</th>
                            <th>Fx</th>
                            <th>e = F<sub>t</sub>-Y<sub>t</sub></th>
                            <th>|e|</th>
                            <th>e<sup>2</sup></th>
                            <th>e/Y<sub>t</sub></th>
                        </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>Semester 1</td>
                        <td><?= $nilai_prediksi->y['Semester 1'] ?></td>
                        <td><?= $nilai_prediksi->fx['Semester 1'] ?></td>
                        <td><?= number_format($nilai_prediksi->err['Semester 1'], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_abs['Semester 1'], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_square['Semester 1'], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_yt['Semester 1'], 2) ?></td>
                    </tr>
                  <?php foreach ($prediksi_value as $key => $val) :
                      ?>
                      <tr>
                        <td><?= $key ?></td>
                        <td><?= $nilai_prediksi->y[$key] ?></td>
                        <td><?= $nilai_prediksi->fx_p[$key] ?></td>
                        <td><?= number_format($nilai_prediksi->err_p[$key], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_abs_p[$key], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_square_p[$key], 2) ?></td>
                        <td><?= number_format($nilai_prediksi->err_yt_p[$key], 2) ?></td>
                      </tr>
                  <?php endforeach ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="table-borderless">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Tabel Hasil Prediksi</h4>
            </div>
            <div class="card-content">
              <!-- table with no border -->
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <thead>
                      <tr>
                          <th>Semester</th>
                          <th>X</th>
                          <th>Fx</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($nilai_prediksi->next_fx as $key => $val) :
                      ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $nilai_prediksi ->next_fx_p[$key] ?></td>
                            <td><?= $val ?></td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="table-borderless">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tabel Analisis Error</h4>
          </div>
          <div class="card-content">
            <!-- table with no border -->
            <div class="table-responsive">
              <table class="table table-borderless mb-0">
                <thead>
                  <tr>
                      <th>Metric</th>
                      <th>Nilai (tanpa penghalusan)</th>
                      <th>Nilai (dengan penghalusan)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>MSE</td>
                    <td><?= number_format($nilai_prediksi->errs['MSE'], 2) ?></td>
                    <td><?= number_format($nilai_prediksi->errs_p['MSE_p'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>RMSE</td>
                    <td><?= number_format($nilai_prediksi->errs['RMSE'], 2) ?></td>
                    <td><?= number_format($nilai_prediksi->errs_p['RMSE_p'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>MAD</td>
                    <td><?= number_format($nilai_prediksi->errs['MAD'], 2) ?></td>
                    <td><?= number_format($nilai_prediksi->errs_p['MAD_p'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>MAPE</td>
                    <td><?= number_format($nilai_prediksi->errs['MAPE'], 2) ?>%</td>
                    <td><?= number_format($nilai_prediksi->errs_p['MAPE_p'], 2) ?>%</td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
      <div class="panel">
        <div id="chartNilai_p" class="card">
        </div>
    </div>
    <div class="panel">
        <div id="chartNilai" class="card">
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-inline-flex p-2">
          <a href="/regresi/mahasiswa" class="btn btn-primary btn-lg mr-auto">Back</a>
      </div>
      <div class="d-inline-flex justify-content-center flex-grow-1">
        @if (round($nilai_prediksi->b, 4) < 0)
        <div class="alert alert-light-danger color-danger">
          <i class="bi bi-exclamation-circle"></i> IP Mahasiswa Menurun!
        </div>
        @else
        <div class="alert alert-light-success color-success">
          <i class="bi bi-check-circle"></i> IP Mahasiswa Meningkat!
        </div>
        @endif
      </div>
  </div>
  </div>
</div>

{{-- For Chart --}}
  @section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    Highcharts.chart('chartNilai_p', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Prediksi IP Mahasiswa Dengan Penghalusan'
        },
        xAxis: {
            categories: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7']
        },
        yAxis: {
            title: {
                text: 'IP Mahasiswa'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Nilai Aktual',
            data: {{ $nilai }}
        }, {
            name: 'Nilai Prediksi',
            data: {{ $prediksi_p }}
        }]
    });
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    Highcharts.chart('chartNilai', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Prediksi IP Mahasiswa Tanpa Penghalusan'
        },
        xAxis: {
            categories: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7']
        },
        yAxis: {
            title: {
                text: 'IP Mahasiswa'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Nilai Aktual',
            data: {{ $nilai }}
        }, {
            name: 'Nilai Prediksi',
            data: {{ $prediksi_n }}
        }]
    });
    </script>
    @endsection
    
@endsection