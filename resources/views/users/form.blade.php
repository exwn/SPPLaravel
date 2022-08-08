<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen User</h3>
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
                        <h4 class="card-title">{{ (isset($user) ? "Sunting User" :
                            "Tambahkan User") }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form action="{{ (isset($user) ? route('user.update', $user->id) : route('user.create')) }}"
                                method="POST" class="card">
                                <div class="form-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="first-name-vertical" placeholder="Masukkan Nama"
                                                    value="{{ isset($user) ? $user->name : old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                    name="email" placeholder="Masukkan Email"
                                                    value="{{ isset($user) ? $user->email : old('email') }}" required>
                                            </div>
                                        </div>
                                        @if(!isset($user))
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Password</label>
                                                <input type="password" id="password-vertical" class="form-control"
                                                    name="password" placeholder="Ketikkan Password"
                                                    value="{{ isset($user) ? $user->password : old('password') }}"
                                                    required>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    {{-- @if(isset($user)) --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="no-telepon">No. Telepon</label>
                                            <input type="number" id="no_telp" class="form-control" name="no_telp"
                                                placeholder="Masukkan Nomor Aktif"
                                                value="{{ isset($user) ? $user->no_telp : old('no_telp') }}" required
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)"
                                                maxlength="13">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">Role</label>
                                            <select class="form-select" id="role" name="role">
                                                <option value="2" disable hidden>Tata Usaha</option>
                                                @foreach ($role as $item)
                                                <option value="{{ $item->id }}" {{ isset($user) ? ($item->id ==
                                                    $user->role_id ? 'selected' : '') : '' }}>{{ $item->name
                                                    }}
                                                </option>
                                                @endforeach
                                                {{-- {{ dd($user) }} --}}
                                                {{-- <option value="1" {{ isset($user) ? ($user->role ==
                                                    'Admin' ? 'selected' : '') : '' }}>Admin</option>
                                                <option value="2" {{ isset($user) ? ($user->role == 'Siswa' ?
                                                    'selected' : '') : '' }}>Tata Usaha</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"
                                            value="save">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
