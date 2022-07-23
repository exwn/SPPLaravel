<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo-pp.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    @if(Auth::user()->role == 'Admin')
    <x-maz-sidebar-item name="Manajemen User" :link="route('user.index')" icon="bi bi-people">
    </x-maz-sidebar-item>
    @endif
    <x-maz-sidebar-item name="Manajemen Pelajar" :link="route('pelajar.index')" icon="bi bi-person-lines-fill">
    </x-maz-sidebar-item>
    @if(Auth::user()->role == 'Admin')
    <x-maz-sidebar-item name="Manajemen Jurusan" :link="route('jurusan.index')" icon="bi bi-building">
    </x-maz-sidebar-item>
    @endif
    <x-maz-sidebar-item name="Manajemen Spp" :link="route('spp.index')" icon="bi bi-receipt">
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen Transaksi" :link="route('transaksi.index')" icon="bi bi-cash-stack">
    </x-maz-sidebar-item>

</x-maz-sidebar>
