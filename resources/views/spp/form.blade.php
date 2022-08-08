<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen SPP</h3>
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
                        <h4 class="card-title">{{ isset($spp) ? "Sunting SPP" : "Tambahkan SPP" }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form class="row needs-validation g-3 p-3" novalidate
                                action="{{ isset($spp) ? route('spp.update', $spp->id) : route('spp.create') }}"
                                method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tahun Ajaran</label>
                                                <input type="text" class="form-control form-control" name="tahun_ajaran"
                                                    id="datepicker" placeholder="Masukkan Tahun Ajaran"
                                                    value="{{ isset($spp) ? $spp->tahun_ajaran : old('tahun_ajaran') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kelas</label>
                                                <input type="text" class="form-control form-control" name="kelas"
                                                    placeholder="Masukkan Kelas"
                                                    value="{{ isset($spp) ? $spp->kelas : old('kelas') }}">
                                                {{-- <select class="form-select" id="kelas" name="kelas">
                                                    <option disable hidden>-- Pilih Kelas --</option>
                                                    <option value="10">Kelas 10</option>
                                                    <option value="11">Kelas 11</option>
                                                    <option value="12">Kelas 12</option> --}}
                                                    {{-- <option value="10" {{ isset($spp) ? ($spp->kelas : old('kelas')
                                                        ? 'selected' : '') : '' }}>Kelas 10
                                                    </option>
                                                    <option value="11" {{ isset($spp) ? ($spp->kelas : old('kelas')
                                                        ? 'selected' : '') : '' }}>Kelas 11
                                                    </option>
                                                    <option value="12" {{ isset($spp) ? ($spp->kelas : old('kelas')
                                                        ? 'selected' : '') : '' }}>Kelas 12
                                                    </option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Total Tagihan</label>
                                                <input type="number" class="form-control form-control"
                                                    name="total_tagihan" placeholder="Masukkan Total Tagihan"
                                                    value="{{ isset($spp) ? $spp->total_tagihan : old('total_tagihan') }}">
                                            </div>
                                        </div>
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
<script>
    $(document).ready(function(){
      $("#datepicker").datepicker({
         format: "yyyy",
         viewMode: "years",
         minViewMode: "years",
         autoclose:true
      });
    })


</script>
