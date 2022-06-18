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
                        <h4 class="card-title">Tambah Spp</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                            @endif

                            <form class="row needs-validation g-3 p-3" novalidate
                                action="{{ isset($spp) ? route('spp.update', $spp->id) : route('spp.create') }}"
                                method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                <input type="text" class="form-control form-control" name="name"
                                                    placeholder="Masukkan Nama Spp"
                                                    value="{{ isset($spp) ? $spp->name : old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Jumlah</label>
                                                <input type="number" class="form-control form-control" name="jumlah"
                                                    placeholder="Masukkan Jumlah"
                                                    value="{{ isset($spp) ? $spp->jumlah : old('jumlah') }}">
                                            </div>
                                        </div>
                                        {{-- @foreach ($spp as $spp => $item)
                                        {{ dd($item->periode->name) }}
                                        @endforeach --}}
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Periode</label>
                                                <input type="text" class="form-control form-control" name="periode"
                                                    placeholder="Masukkan Periode"
                                                    value="{{ isset($spp) ? $spp->periode : old('periode') }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Periode</label>
                                                <select class="form-select" id="periode" name="periode">
                                                    <option value=""></option>
                                                    @foreach ($periode as $item)
                                                    <option value="{{ $item->id }}" {{ isset($spp) ? ($item->id ==
                                                        $spp->periode_id ? 'selected' : '') : '' }}>{{ $item->name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div> --}}
                                        {{-- @foreach ($spp as $index => $item)

                                        {{ dd ($item->periode->name) }}
                                        @endforeach --}}



                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
