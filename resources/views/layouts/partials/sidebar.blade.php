<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen User" :link="route('user.index')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen Periode" :link="route('periode.index')" icon="bi bi-grid-fill">
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen Kelas" :link="route('kelas.index')" icon="bi bi-grid-fill">
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen Spp" :link="route('spp.index')" icon="bi bi-grid-fill">
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Manajemen Transaksi" :link="route('transaksi.index')" icon="bi bi-grid-fill">
    </x-maz-sidebar-item>

</x-maz-sidebar>
