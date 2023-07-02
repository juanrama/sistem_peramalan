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
              <form method="get" action="/ma/mahasiswa/mapred">
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
                        <option value="">Tanpa Penghalusan</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Jenis Kelamin">Jenis Kelamin</option>
                        <option value="SMA">SMA</option>
                      </select>
                      </div>
                    </div>

                  <div class="form-group row">
                    <label for="n_periode" class="col-md-4 col-form-label text-md-right">Periode Moving</label>
                    <div class="col-md-6">
                          <input id="n_periode" type="text" class="form-control @error('n_periode') is-invalid @enderror" name="n_periode" value="{{ old('n_periode', $n_periode) }}" required autocomplete="n_periode" autofocus>
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
              <h4 class="card-title">Tabel Analisis</h4>
            </div>
            <div class="card-content">
              <!-- table with no border -->
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Y (nilai aktual)</th>
                        <th>Fx (prediksi)</th>
                        <th>e<sub>t</sub></th>
                        <th>e<sub>t</sub><sup>2</sup></th>
                        <th>|e<sub>t</sub>|</th>
                        <th>|e<sub>t</sub> / y<sub>t</sub>|</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($prediksi_value as $key => $val) :
                      ?>
                      <tr>
                        <td><?= $key ?></td>
                        <td><?= $nilai_prediksi->y[$key]  ?></td>
                        <td><?= $nilai_prediksi->ft[$key] ?></td>
                        <td><?= isset($nilai_prediksi->et[$key]) ? number_format($nilai_prediksi->et[$key], 2) : '' ?></td>
                        <td><?= isset($nilai_prediksi->et_square[$key]) ? number_format($nilai_prediksi->et_square[$key], 2) : '' ?></td>
                        <td><?= isset($nilai_prediksi->et_abs[$key]) ? number_format($nilai_prediksi->et_abs[$key], 2) : '' ?></td>
                        <td><?= isset($nilai_prediksi->et_yt[$key]) ? number_format($nilai_prediksi->et_yt[$key], 2) : '' ?></td>
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
                        <th>Ft</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nilai_prediksi->next_ft as $key => $val) :
                    ?>
                      <tr>
                          <td>Semester 7</td>
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
                      <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>MSE</td>
                    <td><?= number_format($nilai_prediksi->error['MSE'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>RMSE</td>
                    <td><?= number_format($nilai_prediksi->error['RMSE'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>MAD</td>
                    <td><?= number_format($nilai_prediksi->error['MAE'], 2) ?></td>
                  </tr>
                  <tr>
                    <td>MAPE</td>
                    <td><?= number_format($nilai_prediksi->error['MAPE'], 2) ?>%</td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
      <div class="panel">
        <div id="chartNilai" class="card">
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-inline-flex p-2">
          <a href="/ma/mahasiswa" class="btn btn-primary btn-lg mr-auto">Back</a>
      </div>
      <div class="d-inline-flex justify-content-center flex-grow-1">
        @if ($nilai_prediksi -> y['Semester 6'] > $nilai_prediksi -> next_ft['Semester 7'])
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
    Highcharts.chart('chartNilai', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Prediksi IP Mahasiswa'
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
            data: {{ $prediksi }}
        }]
    });
    </script>
    @endsection
    
@endsection