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
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambahkan Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form action="{{ route('transaksi.pelajar.store') }}" method="POST" class="card"
                                enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                {{-- {{ dd($transaksi) }} --}}
                                                <input type="text" class="form-control" placeholder="Ini Tagihan"
                                                    value="{{ $user->name }}" disabled>
                                                <input type="hidden" value="{{ $user->id }}" name="nama" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Kelas</label>
                                                @foreach ($kelas as $item)
                                                <input type="text" class="form-control" placeholder="Ini Tagihan"
                                                    value="{{ $item->kelas }}" disabled>
                                                <input type="hidden" value="{{ $item->id }}" name="kelas" required>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- {{ dd($jurusan) }} --}}
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Jurusan</label>
                                                @foreach ($jurusan as $item)
                                                <input type="text" class="form-control" placeholder="Ini Jurusan"
                                                    disabled value="{{ $item->name }}">

                                                @endforeach
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
                                                @foreach ($kelas as $item)
                                                <input type="number" id="tagihan" class="form-control" name="tagihan"
                                                    placeholder="Ini Tagihan" value="{{ $item->total_tagihan }}"
                                                    disabled>

                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no-telepon">Jumlah Dibayarkan</label>
                                                <input type="number" id="jumlah_dibayarkan" class="form-control"
                                                    name="jumlah_dibayarkan" placeholder="Masukkan Jumlah"
                                                    value="{{ $item->total_tagihan }}" max="{{ $item->total_tagihan }}"
                                                    required>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                                <input type="file" id="bukti_pembayaran" class="form-control"
                                                    name="bukti_pembayaran" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $item->total_tagihan }}" name="tagihanNumber"
                                        id="tagihanNumber">
                                    {{-- {{ dd(Auth::user()->id) }} --}}
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

        {{-- {{ dd($user->name) }} --}}
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Transaksi</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <a href="{{ route('transaksi.pelajar.print') }}" class="btn btn-outline-primary">Print
                            Transaksi</a>
                    </div>
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1" style="white-space:nowrap;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Bulan</th>
                                    <th>Nama Pelajar</th>
                                    <th>Kelas</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Jumlah Dibayarkan</th>
                                    <th>Tunggakan</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Bertanggung Jawab</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($transaksi as $index => $item)
                                <tr>

                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->spp->tahun_ajaran }}/{{ $item->spp->tahun_ajaran+1 }}</td>
                                    <td>{{ $item->bulan }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->spp->kelas }}</td>
                                    <td>{{ $item->spp->total_tagihan }}</td>
                                    <td>{{ $item->jumlah_dibayarkan }}</td>
                                    <td>{{ $item->tunggakan }}</td>
                                    <td>
                                        {{-- {{ $item->bukti_pembayaran }} --}}
                                        {{-- <img src="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                                            style="height: 100px; width: 150px;"> --}}
                                        <div class="me-1 mb-1 d-inline-block">
                                            <!-- Button trigger for small size modal modal -->
                                            <button type="button" class="btn btn-outline-primary block"
                                                data-bs-toggle="modal" data-bs-target="#small-{{ $item->id }}">
                                                Lihat Bukti
                                            </button>

                                            <!--small size modal -->
                                            <div class="modal fade text-left" id="small-{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel19">Small Modal</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <img src="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                                                                class="img-fluid" data-id="{{ $item->id }}" />

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary btn-sm"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Close</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary ml-1 btn-sm"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-sm-block d-none">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->status }}</td>
                                    {{-- <td>{{ $item->user->name }}</td> --}}
                                    <td></td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>

</x-app-layout>


{{-- <script>
    $(document).ready(function() {
      $('#nama').change(function() {
           var nama = $(event.target).val();
        //    console.log(nama);
            $.ajax({
                type: 'GET',
              url: "{{ route('user.show', ':id') }}".replace(':id', nama),
               data: {_token: "{{ csrf_token() }}"},
                dataType : "JSON",
               success: function(response) {
                  $('#kelas').val(response.spp_kelas);
                  $('#kelasPost').val(response.spp_kelas);
                  $('#jurusan').val(response.jurusan_name);
                  $('#tagihan').val(response.spp_tagihan);
                  $('#tagihanNumber').val(response.spp_tagihan);
                  $('#jumlah_dibayarkan').val(response.spp_tagihan);
                  $('#jumlah_dibayarkan').attr('max', response.spp_tagihan);

                // console.log(response.spp_tagihan);
                },
                error: (err => {
                    console.log(err);
                })
           });
        //    var tunggakan = $('#jumlah_dibayarkan').val();
        //    console.log(tunggakan);
        });
      });
    //   $('#image').filepond();
</script> --}}
