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


    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Hoverable rows</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ route('user.create') }}" class="btn btn-outline-primary">Tambah Pengguna</a>
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
                                        <th>Kelas</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($users as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td></td>
                                        {{-- <td>{{ $item->kelas->name }}</td> --}}
                                        <td>{{ $item->role }}</td>
                                        <td>@if($item->is_active)
                                            <span>Aktif</span>
                                            @else
                                            <span>Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="icon" href="{{ route('user.edit', $item->id) }}"
                                                title="edit item"><i data-feather='edit'></i>
                                            </a>
                                            @if(Auth::user()->id != $item->id)
                                            {!! Form::open(['method' => 'POST','route' => ['user.destroy',
                                            $item->id],'style'=>'display:inline']) !!}
                                            {!! Form::button('<i data-feather="trash-2"></i>', [ 'type'
                                            => 'submit', 'class' => 'btn-link'])
                                            !!}
                                            {!! Form::close() !!}
                                            @endif
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
