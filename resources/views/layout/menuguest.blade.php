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

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
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

                                        <button type="button" class="btn btn-primary"
                                            onClick="bukamodal('{{ $value->id }}', '{{ $value->name_menu }}')">
                                            Beli
                                        </button>

                                        {{-- <form method="POST" action="tambah">
                                            <input type=button value='-'>
                                            <input type=test size=1 id='v' name='v' value='&nbsp; 1'>
                                            <input type=hidden value="{{ $value->id }}" id='modal_id_menu'
                                                name='modal_id_menu'>
                                            <input type=hidden value="{{ $value->id }}" id='modal_id_menu'
                                                name='modal_id_menu'>
                                            <input type=button value='+'>
                                        </form> --}}
                                        {{-- <input name="qty" name="{{ $value->id }} }}" type="asd"> --}}

                                        {{-- <div>
                                            <button onclick="decreaseQuantity({{ $value->id }})">-</button>
                                            <input type="text" id="quantity_{{ $value->id }}"
                                                value="{{ $value->quantity }}" readonly>
                                            <button onclick="increaseQuantity({{ $value->id }})">+</button>
                                        </div> --}}

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End Starter Menu Content -->
                    <?php $n++; ?>
                @endforeach
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Masukkan Jumlah Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="modal-menu" class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Notes</label>
                            <div class="col-sm-11">
                                <input type="notes" name="notes" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <input type=button value='-' onclick='javascript:process(-1)'>
                            <input type=test size=1 id='v' name='v' value='&nbsp; 1'>
                            <input type=hidden id='modal_id_menu' name='modal_id_menu'>
                            <input type=button value='+' onclick='javascript:process(1)'>
                            <a id="id_menu_herf" type="button" class="btn btn-success">
                                Tambah
                            </a>
                        </div>
                        {{-- <a href="{{ route('add.to.cart', $value->id) }}" class="btn btn-success"><i
                            class="bi bi-plus-circle-fill"></i>&nbsp;Tambah pesanan</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Menu Section -->
@endsection

@section('script')
    <script>
        // $("#qty").click(function() {
        //     alert ("ok");
        // });
        function bukamodal(id, name_menu) {
            $("#exampleModal").modal('show');
            $("#modal_id").val(id);
            $("#id_herf").attr("href", "/add-to-cart/" + id);
            $("#modal-menu").html(name_menu);
        }

        function process(v) {
            var value = parseInt(document.getElementById('v').value);
            value += v;
            document.getElementById('v').value = value;
        }
    </script>
@endsection
