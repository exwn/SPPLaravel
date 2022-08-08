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

    <section class="section">
        {{-- <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Pelajar</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ route('pelajar.create') }}" class="btn btn-outline-primary">Tambahkan
                                Pelajar</a>
                        </div>
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                        @endif

                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Telepon</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($pelajar as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td>{{ $item->spp->kelas }}</td>
                                        <td>{{ $item->jurusan->name }}</td>
                                        <td>{{ $item->spp->total_tagihan }}</td>
                                        <td>@if($item->is_active)
                                            <span>Aktif</span>
                                            @else
                                            <span>Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="icon" href="{{ route('pelajar.edit', $item->id) }}"
                                                title="edit item"><i data-feather='edit'></i>
                                            </a>
                                            {!! Form::open(['method' => 'POST','route' => ['pelajar.destroy',
                                            $item->id],'style'=>'display:inline']) !!}
                                            {!! Form::button('<i data-feather="trash-2"></i>', [ 'type'
                                            => 'submit', 'class' => 'btn-link']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Pelajar</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <a href="{{ route('pelajar.create') }}" class="btn btn-outline-primary">Tambahkan Pelajar</a>
                    </div>

                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Total Tagihan</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($pelajar as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->spp->kelas }}</td>
                                    <td>{{ $item->jurusan->name }}</td>
                                    <td>{{ $item->spp->total_tagihan }}</td>
                                    <td>@if($item->is_active)
                                        <span>Aktif</span>
                                        @else
                                        <span>Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="icon" href="{{ route('pelajar.edit', $item->id) }}"
                                            title="edit item"><i data-feather='edit'></i>
                                        </a>
                                        @if(Auth::user()->id != $item->id)
                                        {!! Form::open(['method' => 'POST','route' => ['pelajar.destroy',
                                        $item->id],'style'=>'display:inline']) !!}
                                        {!! Form::button('<i data-feather="trash-2"></i>', [ 'type'
                                        => 'submit', 'class' => 'btn-link show-confirm', 'onclick'=>'return:false'])
                                        !!}
                                        {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ redirect(Request::url()) }} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

<script>
    $('.show-confirm').on('click', function (event) {
    event.preventDefault();
    var form =  $(this).closest("form");
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            form.submit();
        }
    });
    return false;
});
</script>
