<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">This is the main page.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah User</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                            @endif

                            <form class="row needs-validation g-3 p-3" novalidate
                                action="{{route('user.update', [$user->id])}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" value="PUT" name="_method"> --}}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                <input value="{{old('name') ? old('name') : $user->name}}"
                                                    class="form-control {{$errors->first('name') ? " is-invalid" : ""
                                                    }}" placeholder="Full Name" type="text" name="name" id="name" />
                                                <div class="invalid-feedback">
                                                    {{$errors->first('name')}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input value="{{$user->email}}" disabled
                                                    class="form-control {{$errors->first('email') ? " is-invalid" : ""
                                                    }} " placeholder=" user@mail.com" type="text" name="email"
                                                    id="email" />
                                                <div class="invalid-feedback">
                                                    {{$errors->first('email')}}
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Kata Sandi</label>
                                                <input type="password" class="form-control form-control-xl"
                                                    name="password" placeholder="Masukkan Kata Sandi">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Konfirmasi Kata Sandi</label>
                                                <input type="password" class="form-control form-control-xl"
                                                    name="password_confirmation"
                                                    placeholder="Masukkan Ulang Kata Sandi">
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option disable selected hidden>Pilih Status</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Siswa</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1"
                                                value="save">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
