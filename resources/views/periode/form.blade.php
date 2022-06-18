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
                        <h4 class="card-title">Tambah Periode</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                            @endif

                            <form
                                action="{{ (isset($periode) ? route('periode.update', $periode->id) : route('periode.create')) }}"
                                method="POST" class="card">
                                <div class="form-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Periode</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="first-name-vertical" placeholder="Masukkan Nama"
                                                    value="{{ isset($periode) ? $periode->name : old('periode') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tanggal Mulai</label>
                                                <input type="date" class="form-control" name="tanggal_mulai"
                                                    id="first-name-vertical" placeholder="Masukkan Tanggal"
                                                    value="{{ isset($periode) ? $periode->tanggal_mulai : old('periode') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tanggal Akhir</label>
                                                <input type="date" class="form-control" name="tanggal_akhir"
                                                    id="first-name-vertical" placeholder="Masukkan Tanggal"
                                                    value="{{ isset($periode) ? $periode->tanggal_akhir : old('periode') }}"
                                                    required>
                                            </div>
                                        </div>

                                        {{-- @if(!isset($user))

                                        @endif --}}
                                    </div>
                                    {{-- @if(isset($user))

                                    @endif --}}
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
