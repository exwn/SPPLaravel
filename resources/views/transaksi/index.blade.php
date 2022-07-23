<style>
    .btn-link {
        background-color: Transparent;
        background-repeat: no-repeat;
        border: none;
        cursor: pointer;
        overflow: hidden;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Transaksi</h3>
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


    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambahkan Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form action="{{ route('transaksi.create') }}" method="POST" class="card">
                                <div class="form-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                <select class="form-select" id="nama" name="nama">
                                                    <option disabled hidden selected>-- Pilih Nama Pelajar --</option>
                                                    @foreach ($pelajar as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Kelas</label>
                                                <select class="form-select" id="kelas" disabled>
                                                    <option disabled hidden selected>-- Pilih Kelas --</option>
                                                    @foreach ($spp as $item)
                                                    <option value={{ $item->id }}>{{ $item->kelas }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" value="" id="kelasPost" name="kelas">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Jurusan</label>
                                                <input type="email" id="jurusan" class="form-control" name="email"
                                                    placeholder="Ini Jurusan" disabled value="" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Tanggungan Bulan</label>
                                                <select class="form-select" id="bulan" name="bulan">
                                                    @php
                                                    for ($i = 0; $i < 12; $i++) { $time=strtotime(sprintf('%d months',
                                                        $i)); $label=date('F', $time); $value=date('F', $time);
                                                        echo "<option value='$value'>$label</option>" ; } @endphp
                                                        </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no-telepon">Jumlah Tagihan</label>
                                                <input type="number" id="tagihan" class="form-control" name="tagihan"
                                                    placeholder="Ini Tagihan" value="" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no-telepon">Jumlah Dibayarkan</label>
                                                <input type="number" id="jumlah_dibayarkan" class="form-control"
                                                    name="jumlah_dibayarkan" placeholder="Masukkan Jumlah" value=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>
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
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="" class="btn btn-outline-primary">Print Transaksi</a>
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Bulan</th>
                                        <th>Jumlah</th>
                                        <th>Nama Pelajar</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($transaksi as $index => $item)
                                    <tr>

                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->spp->tahun_ajaran }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->jumlah_dibayarkan }}</td>
                                        <td>{{ $item->pelajar->name }}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


<script>
    $(document).ready(function() {
      $('#nama').change(function() {
           var nama = $(event.target).val();
            $.ajax({
                type: 'GET',
              url: "{{ route('pelajar.show', ':id') }}".replace(':id', nama),
               data: {_token: "{{ csrf_token() }}"},
                dataType : "JSON",
               success: function(response) {
                  $('#kelas').val(response.spp_kelas);
                  $('#kelasPost').val(response.spp_kelas);
                  $('#jurusan').val(response.jurusan_name);
                  $('#tagihan').val(response.spp_tagihan);
                  $('#jumlah_dibayarkan').val(response.spp_tagihan);
                  $('#jumlah_dibayarkan').attr('max', response.spp_tagihan);

                // console.log(response.spp_kelas);
                },
                // error: (err => {
                //     console.log(err);
                // })
           });
        });
      });
</script>
