<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Pelajar</h3>
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
                        <h4 class="card-title">{{ (isset($user) ? "Sunting Pelajar" :
                            "Tambahkan Pelajar") }}</h4>
                    </div>
                    <div class="card-content">
                        @include('flash-message')
                        <div class="card-body">
                            <form
                                action="{{ (isset($user) ? route('pelajar.update', $user->id) : route('pelajar.create')) }}"
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

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Password</label>
                                                <input type="password" id="password-vertical" class="form-control"
                                                    name="password" placeholder="Ketikkan Password" value="" {{
                                                    isset($user) ? '' : 'required' }}>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no-telepon">No. Telepon</label>
                                                <input type="number" id="no_telp" class="form-control" name="no_telp"
                                                    placeholder="Masukkan Nomor Aktif"
                                                    value="{{ isset($user) ? $user->no_telp : old('no_telp') }}"
                                                    required
                                                    oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)"
                                                    maxlength="13">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select class="form-select" id="kelas" name="kelas">
                                                    <option disable hidden>-- Pilih Kelas --</option>
                                                    @foreach ($spp as $item)
                                                    <option value="{{ $item->id }}" {{ isset($user) ? ($item->id ==
                                                        $user->kelas_id ? 'selected' : '') : '' }}>{{ $item->kelas
                                                        }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Jurusan</label>
                                                <select class="form-select" id="periode" name="jurusan">
                                                    <option disabled hidden selected>-- Pilih Jurusan --</option>
                                                    @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id }}" {{ isset($user) ? ($item->id ==
                                                        $user->jurusan_id ? 'selected' : '') : '' }}>{{ $item->name
                                                        }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($user))

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type='hidden' value='0'
                                            id="flexSwitchCheckChecked" name="is_active">
                                        <input class="form-check-input" type="checkbox" value='1'
                                            id="flexSwitchCheckChecked" name="is_active" {{ isset($user) ?
                                            ($user->is_active ? 'checked' : '') : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Aktif</label>
                                    </div>
                                    @endif
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
<script>
    $(document).ready(function(){
    $('#first-name-vertical').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});
</script>
