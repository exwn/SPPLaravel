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
    {{-- {{ dd($transaksi) }} --}}

    <section class="section">
        @if(session('success'))
        <div class="error">{{ session('success') }}<div>
                @endif
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Example Content</h4>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis
                        laudantium tempore
                        exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio
                        reprehenderit
                        distinctio incidunt! Vel aspernatur dicta consequatur!
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Pelajar</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pelajar }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Transaksi</h6>
                                        <h6 class="font-extrabold mb-0">{{ $transaksi }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Uang</h6>
                                        <h6 class="font-extrabold mb-0">Rp. {{ format_idr($total_uang) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Lunas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $lunas }} / {{ $pelajar }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Diagram Pelajar</h4>
            </div>
            <div class="card-body">
                {{ $chart->container() }}
            </div>
        </div>
    </section>

</x-app-layout>
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
{{-- <script>
    var options = {
  chart: {
    type: 'bar'
  },
  series: [{
    name: 'sales',
    data: [30,40,35,50,49,60,70,91,125]
  }],
  xaxis: {
    categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script> --}}
