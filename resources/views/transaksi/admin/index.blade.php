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

    {{-- {{ dd(Auth::user()->name) }} --}}
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambahkan Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('flash-message')

                            <form action="{{ route('transaksi.create') }}" method="POST" class="card"
                                enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama</label>
                                                <select class="form-select" id="nama" name="nama">
                                                    <option disabled hidden selected>-- Pilih Nama Pelajar --</option>
                                                    @foreach ($user as $index => $item)
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
                                                    placeholder="Ini Jurusan" disabled value="">
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
                                                    placeholder="Ini Tagihan" value="" disabled>
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
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                                <input type="file" id="bukti_pembayaran" class="form-control"
                                                    name="bukti_pembayaran" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="" name="tagihanNumber" id="tagihanNumber">
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
                        <a href="{{ route('transaksi.print') }}" class="btn btn-outline-primary">Print Transaksi</a>
                    </div>
                    {{-- @include('flash-message') --}}
                    <!-- table hover -->
                    <div class="table-responsive mx-4 mb-4">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Bulan</th>
                                    <th>Nama Pelajar</th>
                                    <th>Kelas</th>
                                    {{-- <th>Jumlah Tagihan</th> --}}
                                    <th>Jumlah Dibayarkan</th>
                                    {{-- <th>Tunggakan</th> --}}
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    {{-- <th>Keterangan</th> --}}
                                    {{-- <th>Bertanggung Jawab</th> --}}
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($transaksi as $index => $item)
                                <tr>

                                    <td class="text-muted">{{ $index+1 }}</td>
                                    <td>{{ $item->spp->tahun_ajaran }}/{{ $item->spp->tahun_ajaran+1 }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->bulan }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->spp->kelas }}</td>
                                    {{-- <td>{{ $item->spp->total_tagihan }}</td> --}}
                                    <td>IDR. {{ format_idr($item->jumlah_dibayarkan) }}
                                    </td>
                                    {{-- <td>
                                        @if ($item->tunggakan == 0)
                                        -
                                        @elseif($item->tunggakan > 0)
                                        {{ $item->tunggakan }}
                                        @endif
                                    </td> --}}

                                    <td>
                                        @if ($item->status == 1)
                                        <span class="badge bg-light-success">Lunas</span>
                                        @elseif($item->status == 2)
                                        <span class="badge bg-light-warning">Proses</span>
                                        @elseif($item->status == 0)
                                        <span class="badge bg-light-danger">Belum Lunas</span>
                                        @endif
                                        {{-- {{ $item->status }} --}}
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary block btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $item->id }}"
                                            data-id="{{ $item->id }}">
                                            Lihat Bukti
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop-{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <img src="{{ asset('bukti_pembayaran/'.$item->bukti_pembayaran) }}"
                                                            class="img-fluid" data-id="{{ $item->id }}" />
                                                    </div>
                                                    <form action="/transaksi/{{$item->id}}/ubah" method="POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <div>Total Tagihan : Rp. {{
                                                                    format_idr($item->spp->total_tagihan) }}
                                                                </div>
                                                                <div>Jumlah Dibayarkan : Rp. {{
                                                                    format_idr($item->jumlah_dibayarkan) }}
                                                                </div>
                                                                @if ($item->tunggakan == 0)
                                                                <div>Tunggakan : <span
                                                                        class="badge bg-light-success">Lunas</span>
                                                                </div>
                                                                @else
                                                                <div>Tunggakan : {{ $item->tunggakan }}</div>
                                                                @endif
                                                                @csrf
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="lunas" id="flexRadioDefault1" value="1">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault1">
                                                                        Lunas
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="lunas" id="flexRadioDefault2" value="2">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault2">
                                                                        Belum Lunas
                                                                    </label>
                                                                </div>

                                                                <div class="form-floating">
                                                                    <textarea class="form-control"
                                                                        placeholder="Leave a comment here"
                                                                        id="floatingTextarea"
                                                                        name="keterangan"></textarea>
                                                                    <label for="floatingTextarea">Keterangan</label>
                                                                </div>
                                                            </div>
                                                            {{-- <button type="submit"
                                                                class="btn btn-primary">Submit</button> --}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Confirm</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>{{ $item->keterangan }}</td> --}}
                                    {{-- <td>{{ $item->user->name }}</td> --}}
                                    {{-- <td></td> --}}

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


<script>
    $(document).ready(function() {
      $('#nama').change(function() {
           var nama = $(event.target).val();
        //    console.log(nama);
            $.ajax({
                type: 'GET',
              url: "{{ route('transaksi.show', ':id') }}".replace(':id', nama),
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
    $(document).ready(function () {
    $('#table1').DataTable();
    });
</script>
