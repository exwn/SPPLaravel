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


    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar SPP</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ route('spp.create') }}" class="btn btn-outline-primary">Tambahkan SPP</a>
                        </div>
                        @include('flash-message')

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Kelas</th>
                                        <th>Total Tagihan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($spp as $index => $item)
                                    <tr>
                                        <td class="text-muted">{{ $index+1 }}</td>
                                        <td>{{ $item->tahun_ajaran }}/{{ $item->tahun_ajaran+1 }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>Rp. {{ format_idr($item->total_tagihan) }}</td>
                                        <td class="text-center">
                                            <a class="icon" href="{{ route('spp.edit', $item->id) }}"
                                                title="edit item"><i data-feather='edit'></i>
                                            </a>
                                            {{-- {!! Form::open(['method' => 'POST','route' => ['spp.destroy',
                                            $item->id],'style'=>'display:inline']) !!}
                                            {!! Form::button('<i data-feather="trash-2"></i>', [ 'type'
                                            => 'submit', 'class' => 'btn-link'])
                                            !!}
                                            {!! Form::close() !!} --}}
                                        </td>

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
    $('.btn-link').on('click', function (event) {
        event.preventDefault();
        var form =  $(this).closest("form");
        Swal.fire({
        title: 'Anda yakin ingin menghapus?',
        text: 'SPP yang dihapus tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yaa, hapus SPP!',
        cancelButtonText: 'Batal',
        }).then((result) => {
            setTimeout(() => {

                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Terhapus!',
                        'SPP sudah terhapus.',
                        'success'
                        )
                }
            }, 1500);
        })
    });
</script>
