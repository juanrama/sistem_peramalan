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
            <h3>Ubah Data Mahasiswa</h3>
            <p class="text-subtitle text-muted">
              Silahkan isi form berikut ini
            </p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
              aria-label="breadcrumb"
              class="breadcrumb-header float-start float-lg-end"
            >
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Form Layout
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <section id="basic-horizontal-layouts">
        <div class="row match-height">
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <form method="post" action="{{ route('database.update', $akademik->id) }}" class="form form-horizontal">
                    @method('put')
                    @csrf
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="id_mhs"
                            >ID Mahasiswa</label
                          >
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="text"
                            id="id_mhs"
                            class="form-control @error('id_mhs') is-invalid @enderror"
                            name="id_mhs"
                            placeholder="ID Mahasiswa"
                            value="{{ old('id_mhs', $akademik -> id_mhs)  }}"
                            disabled
                          />
                          @error('id_mhs')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="angkatan">Angkatan</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            id="angkatan"
                            class="form-control @error('angkatan') is-invalid @enderror"
                            name="angkatan"
                            placeholder="Tahun Angkatan"
                            min="2017"
                            max="2019"
                            value="{{ old('angkatan', $akademik -> angkatan)  }}"
                          />
                          @error('angkatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="id_prodi"
                            >Prodi</label
                          >
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            id="id_prodi"
                            class="form-control @error('prodi') is-invalid @enderror"
                            name="id_prodi"
                            placeholder="ID Prodi"
                            min="78"
                            max="887"
                            value="{{ old('id_prodi', $akademik -> id_prodi)  }}"
                          />
                          @error('id_prodi')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="sma">SMA</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            id="sma"
                            class="form-control @error('sma') is-invalid @enderror"
                            name="sma"
                            placeholder="ID SMA"
                            value="{{ old('sma', $akademik -> sma) }}"
                          />
                          @error('sma')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                          <div class="col-md-4">
                            <label for="kabupaten">Kabupaten</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <input
                              type="number"
                              id="kabupaten"
                              class="form-control @error('kabupaten') is-invalid @enderror"
                              name="kabupaten"
                              placeholder="ID Kabupaten"
                              value="{{ old('kabupaten', $akademik -> kabupaten) }}"
                            />
                            @error('kabupaten')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                            <div class="col-md-4">
                              <label for="jk">Jenis Kelamin</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input
                                type="number"
                                id="jk"
                                class="form-control @error('jk') is-invalid @enderror"
                                name="jk"
                                placeholder="1 = Laki-Laki, 2 = Perempuan"
                                min="1"
                                max="2"
                                value="{{ old('jk', $akademik -> jk) }}"
                              />
                              @error('jk')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            </div>
                          <div class="col-md-4">
                            <label for="q_kab">Quartil Kabupaten</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select id="q_kab" class="form-control @error('q_kab') is-invalid @enderror" name="q_kab" value = "{{ old('q_kab', $akademik -> q_kab) }}">
                              @foreach ($q_kab as $kab)
                                <option>{{ $kab }}</option>
                              @endforeach
                            </select>
                            @error('q_kab')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="q_jk">Quartil Jenis Kelamin</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select id="q_jk" class="form-control @error('q_jk') is-invalid @enderror" name="q_jk" value = "{{ old('q_jk', $akademik -> q_jk) }}">
                              @foreach ($q_jk as $jk)
                                <option>{{ $jk }}</option>
                              @endforeach
                            </select>
                            @error('q_jk')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="q_sma">Quartil SMA</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <select id="q_sma" class="form-control @error('q_sma') is-invalid @enderror" name="q_sma" value = "{{ old('q_sma', $akademik -> q_sma) }}">
                              @foreach ($q_sma as $sma)
                                <option>{{ $sma }}</option>
                              @endforeach
                            </select>
                            @error('q_sma')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        <div class="col-md-4">
                        <label for="semester_1">IP Semester 1</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            step="0.01"
                            id="semester_1"
                            class="form-control @error('semester_1') is-invalid @enderror"
                            name="semester_1"
                            placeholder="IP Semester 1"
                            min="0"
                            max="4"
                            value="{{ old('semester_1', $akademik -> semester_1)  }}"
                          />
                          @error('semester_1')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="semester_2">IP Semester 2</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <input
                              type="number"
                              step="0.01"
                              id="semester_2"
                              class="form-control @error('semester_2') is-invalid @enderror"
                              name="semester_2"
                              placeholder="IP Semester 2"
                              value="{{ old('semester_2', $akademik -> semester_2)  }}"
                            />
                            @error('semester_2')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="semester_3">IP Semester 3</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input
                                type="number"
                                step="0.01"
                                id="semester_3"
                                class="form-control @error('semester_3') is-invalid @enderror"
                                name="semester_3"
                                placeholder="IP Semester 3"
                                min="0"
                                max="4"
                                value="{{ old('semester_3', $akademik -> semester_3)  }}"
                              />
                              @error('semester_3')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            </div>
                            <div class="col-md-4">
                              <label for="semester_4">IP Semester 4</label>
                              </div>
                              <div class="col-md-8 form-group">
                                <input
                                  type="number"
                                  step="0.01"
                                  id="semester_4"
                                  class="form-control @error('semester_4') is-invalid @enderror"
                                  name="semester_4"
                                  placeholder="IP Semester 4"
                                  min="0"
                                  max="4"
                                  value="{{ old('semester_4', $akademik -> semester_4)  }}"
                                />
                                @error('semester_4')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-md-4">
                                <label for="semester_5">IP Semester 5</label>
                                </div>
                                <div class="col-md-8 form-group">
                                  <input
                                    type="number"
                                    step="0.01"
                                    id="semester_5"
                                    class="form-control @error('semester_5') is-invalid @enderror"
                                    name="semester_5"
                                    placeholder="IP Semester 5"
                                    min="0"
                                    max="4"
                                    value="{{ old('semester_5', $akademik -> semester_5)  }}"
                                  />
                                  @error('semester_5')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-md-4">
                                  <label for="semester_6">IP Semester 6</label>
                                  </div>
                                  <div class="col-md-8 form-group">
                                    <input
                                      type="number"
                                      step="0.01"
                                      id="semester_6"
                                      class="form-control @error('semester_6') is-invalid @enderror"
                                      name="semester_6"
                                      placeholder="IP Semester 6"
                                      value="{{ old('semester_6', $akademik -> semester_6)  }}"
                                    />
                                    @error('semester_6')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                          <button
                            type="submit"
                            class="btn btn-primary me-1 mb-1"
                          >
                            Submit
                          </button>
                          <button
                            type="reset"
                            class="btn btn-light-secondary me-1 mb-1"
                          >
                            Reset
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="d-flex mt-1">
              <a href="/database/akademik" class="btn btn-primary btn-lg mr-auto">Back</a>
          </div>
          </div>
        </section>
    </div>
    
@endsection