@extends('layoutnew.guest')

@section('content')
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Menu</h2>
                <p>Check Our <span>Yummy Menu</span></p>
            </div>

            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <?php $n = 0; ?>
                @foreach ($menu_tenant_lama as $key => $judul)
                    <li class="nav-item">
                        @if ($loop->first)
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                                <h4>{{ $judul }}</h4>
                            </a>
                        @else
                            <a class="nav-link " data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                                <h4>{{ $judul }}</h4>
                            </a>
                        @endif

                    </li><!-- End tab nav item -->
                @endforeach
            </ul>


            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                <?php $n = 0; ?>
                @foreach ($menu_tenant as $key => $menu)
                    <div class="tab-pane fade   <?php if ($n == 0) {
                        echo 'active show';
                    } ?> " id="{{ $key }}">
                        <div class="tab-header text-center">
                            <p>Menu </p>
                        </div>
                        <div class="row gy-5">
                            @foreach ($menu as $value)
                                <div class="col-lg-4 menu-item">
                                    <a href="{{ asset('/') }}assets/img/menu/menu-item-6.png" class="glightbox"><img
                                            src="{{ url('storage/' . $value->foto) }}" class="menu-img img-fluid"
                                            alt=""></a>
                                    <h4>{{ $value->name }}</h4>
                                    <p class="ingredients">
                                        {{ $value->desc }}
                                    </p>
                                    <p class="price">
                                        Rp {{ number_format($value->harga) }}
                                    </p>
                                    <div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btn-number"
                                                    onClick="jumlah('jumlah{{ $value->id }}','{{ $value->id }}','kurang')"
                                                    data-type="minus"
                                                    style="background-color:#ec2727; color: white;">-</button>
                                            </div>
                                            <input type="text" class="form-control text-center"
                                                id="jumlah{{ $value->id }}" value="0">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btn-number"
                                                    style="background-color:#ec2727; color: white;"
                                                    onClick="jumlah('jumlah{{ $value->id }}','{{ $value->id }}','tambah')"
                                                    data-type="plus">+</button>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Menu Item -->
                            @endforeach
                        </div>
                    </div>
                    <?php $n++; ?>
                @endforeach
            </div>

        </div>
    </section><!-- End Menu Section -->
    <!-- Large modal -->
    <div class="modal" id="modal-checkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Keranjang Pesanan
                    </h5>
                    <button type="button" class="close" onclick="CloseCheckout()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="listmenu">

                    <div class="d-flex justify-content-end">
                        <h5>Total: <span class="price text-success">89$</span></h5>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick='CloseCheckout()'>Close</button>

                    <div>
                        <button type="button" class="btn btn-primary" onClick="Bayar()"><i class="fa fa-money-bill"></i>
                            Cash</button>
                        <button type="button" class="btn btn-success" id="pay-button"><i class="fa fa-credit-card"></i>
                            Online
                            Payment</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start text-black p-4">
                    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">No Meja XXX</h5>
                    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                    <p class="mb-0" style="color: #35558a;">List Pesanan</p>
                    <hr class="mt-2 mb-4"
                        style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">

                    <div id="ListOrder"></div>


                </div>
                <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                    <button type="button" class="btn btn-primary btn-lg mb-1" style="background-color: #35558a;">
                        Track your order
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        @foreach ($tmp as $value)
            $("#jumlah{{ $value->id_menu }}").val("{{ $value->qty }}");
        @endforeach
        $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");

        $("#listmenu").load("{{ url('list-pesanan') }}");

        function jumlah(idhasil, idmenu, jenis) {
            var idhasil = idhasil;
            var hasil = $("#" + idhasil).val();
            if (jenis == 'tambah') {
                hasil = parseInt(hasil) + 1;
            } else {
                hasil = parseInt(hasil) - 1;
            }
            if (hasil < 0) {
                hasil = 0;
            }


            $("#" + idhasil).val(hasil);
            if (hasil >= 0) {
                TambahPesanan(hasil, idmenu);
            }

        }

        function Checkout() {
            $("#modal-checkout").modal('show');
        }

        function CloseCheckout() {
            $('#modal-checkout').modal('hide');
        }

        function TambahPesanan(qty, idmenu) {
            var data = {
                'id_menu': idmenu,
                'no_transaksi': '{{ $faktur }}',
                "qty": qty,
                "total": 0
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('tambah-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");
                    toastr.success('Keranjang berhasil diperbarui', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }

        function DeleteDataKeranjang(id_transaksi, id_menu) {
            var data = {
                'id_menu': id_menu,
                'no_transaksi': id_transaksi

            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('delete-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");

                    toastr.error('Data berhasil dihapus', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }

        function Bayar() {

            $('#modal-checkout').modal('hide');
            $("#modal-order").modal('show');
            $("#ListOrder").load("{{ url('order') }}");
        }

        function UpdateNotes(id) {
            var notes = $("#notes" + id).val();
            var data = {
                'id': id,
                "notes": notes

            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('notes-pesanan') }}",
                data: data,
                dataType: "JSON",
                success: function() {

                    $("#lblCartCount").load("{{ url('jumlah-pesanan') }}");
                    $("#listmenu").load("{{ url('list-pesanan') }}");

                    toastr.error('Data berhasil dihapus', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
