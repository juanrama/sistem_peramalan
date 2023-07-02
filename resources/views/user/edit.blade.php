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
            <h3>Ubah Role User</h3>
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
                  <form method="post" action="{{ route('database_user.update', $user->id) }}" class="form form-horizontal">
                    @method('put')
                    @csrf
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="name"
                            >Nama</label
                          >
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="text"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Nama"
                            value="{{ old('name', $user -> name)  }}"
                            disabled
                          />
                          @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="Email">Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            placeholder="Email"
                            value="{{ old('email', $user -> email)  }}"
                            disabled
                          />
                          @error('email')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="role">Role</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                            @foreach ($roles as $role)
                              <option>{{ $role }}</option>
                            @endforeach
                          </select>
                          @error('role')
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
              <a href="/database/user" class="btn btn-primary btn-lg mr-auto">Back</a>
          </div>
          </div>
        </section>
    </div>
    
@endsection