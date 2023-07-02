@extends('layout.viewmenu')

@section('content')
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
        <div class="container">

            <div class="section-header">
                {{-- <h2>Our Menu</h2> --}}
                <p>Our <span> Menu</span></p>
            </div>
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <?php $n = 0; ?>
                @foreach ($menu_tenant_lama as $key => $judul)
                    <li class="nav-item">
                        <a class="nav-link <?php if ($n == 0) {
                            echo 'active show';
                        } ?>  " data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                            <h4>{{ $judul }}</h4>
                        </a>
                    </li><!-- End tab nav item -->
                    <?php $n++; ?>
                @endforeach
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="00">
                <?php $n = 0; ?>

                @foreach ($menu_tenant as $key => $menu)
                    <div class="tab-pane fade   <?php if ($n == 0) {
                        echo 'active show';
                    } ?> " id="{{ $key }}">

                        <div class="tab-header text-center">
                            <p>Menu</p>
                            {{-- <h3>{{ $key }}</h3> --}}
                        </div>

                        <div class="row g-3">
                            @foreach ($menu as $value)
                                <div class="card col-6 rounded-7 bg-white text-center">
                                    <div class="p-3">
                                        <img class="menu-img img-fluid rounded" sizes="180x180"
                                            src="{{ url('/picture_menu/' . $value->foto_menu) }}">

                                        <h5>{{ $value->name_menu }}</h5>
                                        <p class="ingredients">
                                            {{ $value->desc_menu }}
                                        </p>
                                        <p class="price">
                                            {{-- Rp.{{ $value->harga_menu }} --}}
                                            <?php echo 'Rp' . number_format($value->harga_menu, 0, ',', '.'); ?>
                                        </p>
                                        <form method="POST" action="tambah">
                                            <input type=button value='-'>
                                            <input type=test size=1 id='v' name='v' value='&nbsp; 1'>
                                            <input type=hidden value="{{ $value->id }}" id='modal_id_menu'
                                                name='modal_id_menu'>
                                            <input type=hidden value="{{ $value->id }}" id='modal_id_menu'
                                                name='modal_id_menu'>
                                            <input type=button value='+'>
                                            {{-- <input name="qty" name="{{ $value->id }} }}" type="asd"> --}}
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End Starter Menu Content -->
                    <?php $n++; ?>
                @endforeach
            </div>
        </div>
    </section><!-- End Menu Section -->
@endsection
{{-- <script language=javascript>
    function process(v) {
        var value = parseInt(document.getElementById('v').value);
        value += v;
        document.getElementById('v').value = value;
    }
</script> --}}
