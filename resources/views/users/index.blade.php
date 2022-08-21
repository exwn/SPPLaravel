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
                <h3>Manajemen User</h3>
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
                        <h4 class="card-title">Daftar User</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ route('user.create') }}" class="btn btn-outline-primary">Tambahkan User</a>
                        </div>

                        @include('flash-message')

                        <!-- table hover -->
                        <div class="table-responsive mx-4 mb-4">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($users as $index => $item)
                                    <tr>
                                        <td class="text-muted">{{ $index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role->name }}</td>
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
                        {{-- {{ $users->links() }} --}}
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
        text: 'User yang dihapus tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yaa, hapus user!',
        cancelButtonText: 'Batal',
        }).then((result) => {
            setTimeout(() => {

                if (result.isConfirmed) {
                    form.submit();
                    // const Toast = Swal.mixin({
                    //   toast: true,
                    //   position: 'top-end',
                    //   showConfirmButton: false,
                    //   timer: 3000,
                    //   timerProgressBar: true,
                    //   didOpen: (toast) => {
                    //     toast.addEventListener('mouseenter', Swal.stopTimer)
                    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
                    //   }
                    // })
                    // Toast.fire({
                    //   icon: 'success',
                    //   title: 'User sudah terhapus.'
                    // })
                    Swal.fire(
                        'Terhapus!',
                        'User sudah terhapus.',
                        'success'
                        )
                }
            }, 1500);
        })
    });
    $(document).ready(function () {
    $('#table').DataTable();
    });
</script>
{{-- <script>
    $('#show-confirm').on('click', function (event) {
        event.preventDefault();
    var form =  $(this).closest("form");
    const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
    });
</script> --}}
