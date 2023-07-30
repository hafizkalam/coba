@extends('admin.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                                    class="fa fa-eye"></i> Filter</button>
<<<<<<< HEAD
                            @if (Auth::user()->level == '1' || Auth::user()->level == '2')
                                <a href="{{ url('print') }}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                            @endif
=======
                            <a href="{{ url('print') }}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <th>No Transaksi</th>
<<<<<<< HEAD
                                        <th>Nama Pemesan</th>
                                        <th>Email Pemesan</th>
                                        <th>Telp Pemesan</th>
=======
                                        <th>Nama Pemesanan</th>
                                        <th>Email Pemesanan</th>
                                        <th>Telp Pemesanan</th>
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                        <th>No Meja</th>
                                        <th>Total</th>
                                        <th>Cara Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Otorisasi</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data as $value)
                                        <?php $no++;
                                        $total = 0; ?>
                                        <tr>
                                            @foreach ($value['detail'] as $value1)
<<<<<<< HEAD
                                                @if (Auth::user()->level == 2)
=======
                                                @if (Auth::user()->level != 1)
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                                    @if ($value1['menu']['master_tenants_id'] == $tenant->id)
                                                        <?php $total += $value1['total']; ?>
                                                    @endif
                                                @else
<<<<<<< HEAD
                                                    @if (isset($id_filter_tenant))
                                                        @if ($value1['menu']['master_tenants_id'] == @$id_filter_tenant)
                                                            <?php $total += $value1['total']; ?>
                                                        @endif
                                                    @else
                                                        <?php $total += $value1['total']; ?>
                                                    @endif
=======
                                                    <?php $total += $value1['total']; ?>
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                                @endif
                                            @endforeach
                                            <td>{{ $value['tgl_transaksi'] }}</td>
                                            <td>{{ $value['no_transaksi'] }}</td>
                                            <td>{{ $value['nama_pemesan'] }}</td>
                                            <td>{{ $value['email_pemesan'] }}</td>
                                            <td>{{ $value['telp_pemesan'] }}</td>
                                            <td>{{ $value['no_meja'] }}</td>
                                            <td>{{ number_format($total) }}</td>
<<<<<<< HEAD
                                            <td><span class="badge badge-primary">{{ $value['cara_pembayaran'] }}
                                                </span>
                                            </td>
                                            @if (Auth::user()->level == '1' || Auth::user()->level == '3')
                                                <td>
                                                    @if ($value['status_pembayaran'] != 0)
                                                        <span class="badge badge-info"> Telah Diotorisasi</span>
                                                    @else
                                                        <button class="btn btn-success"
                                                            onClick="Otorisasi('{{ $value['no_transaksi'] }}','1','{{ $total }}')"><i
                                                                class="fa fa-check"> </i></button>
                                                        <button class="btn btn-danger"
                                                            onClick="Otorisasi('{{ $value['no_transaksi'] }}','2')"><i
                                                                class="fa fa-times">
                                                            </i></button>
                                                    @endif
                                                </td>
                                            @else
                                                <td>
                                                    @if ($value['status_pembayaran'] == 0)
                                                        <span class="badge badge-warning"> Menunggu Otorisasi</span>
                                                    @elseif ($value['status_pembayaran'] == 1)
                                                        <span class="badge badge-success"> Disetujui</span>
                                                    @else
                                                        <span class="badge badge-danger"> Ditolak</span>
                                                    @endif

                                                </td>
                                            @endif
                                            <td>
                                                <table>
                                                    <tr>
                                                        @if (Auth::user()->level != '2')
                                                            <th>Nama Tenant</th>
                                                        @endif
=======
                                            <td><span class="badge badge-primary">{{ $value['cara_pembayaran'] }} </span>
                                            </td>
                                            <td>
                                                @if ($value['status_pembayaran'] == 0)
                                                    <span class="badge badge-warning"> Menunggu Otorisasi</span>
                                                @elseif ($value['status_pembayaran'] == 1)
                                                    <span class="badge badge-success"> Disetujui</span>
                                                @else
                                                    <span class="badge badge-danger"> Ditolak</span>
                                                @endif
                                            <td>
                                                @if ($value['status_pembayaran'] != 0)
                                                    <span class="badge badge-info"> Telah Diotorisasi</span>
                                                @else
                                                    <button class="btn btn-success"
                                                        onClick="Otorisasi('{{ $value['no_transaksi'] }}','1')"><i
                                                            class="fa fa-check"> </i></button>
                                                    <button class="btn btn-danger"
                                                        onClick="Otorisasi('{{ $value['no_transaksi'] }}','2')"><i
                                                            class="fa fa-times">
                                                        </i></button>
                                                @endif

                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <th>Nama Tenant</th>
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                                        <th>Nama Menu</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                    @foreach ($value['detail'] as $value1)
<<<<<<< HEAD
                                                        @if (Auth::user()->level == 2)
                                                            @if ($value1['menu']['master_tenants_id'] == @$tenant->id)
                                                                <tr>
                                                                    <td>{{ $menu[$value1['id_menu']]['name'] }}</td>
                                                                    <td>{{ $value1['qty'] }}</td>
                                                                    <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}
                                                                    </td>
                                                                    <td>{{ number_format($value1['total']) }}</td>
                                                                    <td>{{ $value1['notes'] }}</td>
                                                                </tr>
                                                            @endif
                                                        @else
                                                            @if (isset($id_filter_tenant))
                                                                @if ($value1['menu']['master_tenants_id'] == @$id_filter_tenant)
                                                                    <tr>
                                                                        <td>{{ $nama_tenant[$value1['menu']['master_tenants_id']] }}
                                                                        </td>
                                                                        <td>{{ $menu[$value1['id_menu']]['name'] }}
                                                                        </td>
                                                                        <td>{{ $value1['qty'] }}</td>
                                                                        <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}
                                                                        </td>
                                                                        <td>{{ number_format($value1['total']) }}</td>
                                                                        <td>{{ $value1['notes'] }}</td>
                                                                    </tr>
                                                                @endif
                                                            @else
=======
                                                        @if (Auth::user()->level != 1)
                                                            @if ($value1['menu']['master_tenants_id'] == $tenant->id)
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                                                <tr>
                                                                    <td>{{ $nama_tenant[$value1['menu']['master_tenants_id']] }}
                                                                    </td>
                                                                    <td>{{ $menu[$value1['id_menu']]['name'] }}</td>
                                                                    <td>{{ $value1['qty'] }}</td>
                                                                    <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}
                                                                    </td>
                                                                    <td>{{ number_format($value1['total']) }}</td>
                                                                    <td>{{ $value1['notes'] }}</td>
                                                                </tr>
                                                            @endif
<<<<<<< HEAD
=======
                                                        @else
                                                            <tr>
                                                                <td>{{ $menu[$value1['id_menu']]['name'] }}</td>
                                                                <td>{{ $value1['qty'] }}</td>
                                                                <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}
                                                                </td>
                                                                <td>{{ number_format($value1['total']) }}</td>
                                                                <td>{{ $value1['notes'] }}</td>
                                                            </tr>
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form methode="GET" action="{{ url('transaksi') }}">
                    <div class="modal-header">
                        <h4 class="modal-title">Filter</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="awal" value="{{ date('Y-m-01') }}">
                            </div>
                            <div class="col-sm-1">
                                <label for="name" class="col-sm-3 col-form-label">s/d</label>
                            </div>

                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="akhir" value="{{ date('Y-m-t') }}">
                            </div>
                        </div>
<<<<<<< HEAD
                        @if (Auth::user()->level == '1' || Auth::user()->level == '3')
=======
                        @if (Auth::user()->level == '1')
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Tenant</label>
                                <div class="col-sm-6">
                                    <select class="custom-select form-control-border" id="exampleSelectBorder"
                                        name="filter-tenant">
<<<<<<< HEAD
                                        <option value="">Semua Tenant</option>
=======
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
                                        @foreach ($nama_tenant as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Pembayaran</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio" name="cara_pembayaran" value=""
                                        checked> Semua
                                </label>
                                <label class="radio-inline"> <input type="radio" name="cara_pembayaran" value="Cash">
                                    Cash
                                </label>
                                <label class="radio-inline"> <input type="radio" name="cara_pembayaran" value="Online">
                                    Online
                                    Payment
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Status Otorisasi</label>
                            <div class="col-sm-8">
                                <label class="radio-inline"> <input type="radio" name="status_pembayaran" value=""
                                        checked> Semua </label>

                                <label class="radio-inline"> <input type="radio" name="status_pembayaran"
                                        value="0">
                                    Menunggu Otorisasi </label>
                                <label class="radio-inline"> <input type="radio" name="status_pembayaran"
                                        value="1">
                                    Disetujui </label>
                                <label class="radio-inline"> <input type="radio" name="status_pembayaran"
                                        value="2">
                                    Ditolak </label>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Preview</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
<<<<<<< HEAD
    <div class="modal" id="hitung" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" onclick="CloseReview()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="isi-hitung">
                    <form>
                        <div class="form-group">
                            <label for="total">Total Harga</label>
                            <input type="text" class="form-control" id="total" placeholder="Masukkan total bayar"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="cash">Uang Cash</label>
                            <input type="text" class="form-control" id="cash"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' onBlur="Hitung()"
                                placeholder="Masukkan uang cash">
                        </div>
                        <div class="form-group">
                            <label for="total">Kembalian</label>
                            <input type="text" class="form-control" id="kembalian" value="0" disabled>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="BayarOtorisasi()">Bayar</button>
                        <input type="text" class="d-none" id="id_transaksi">
                        <input type="text" class="d-none" id="acc">
                    </form>
                </div>

            </div>
        </div>
    </div>
=======
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
@endsection

@section('script')
    <script>
        $("#example1").DataTable({
            responsive: true,
<<<<<<< HEAD

            order: [
                [1]
            ]
        });

        function BayarOtorisasi() {
            var data = {
                'faktur': $("#id_transaksi").val(),
                "acc": $("#acc").val()
=======
            order: [
                [1, 'desc']
            ]
        });

        function Otorisasi(faktur, acc) {
            var data = {
                'faktur': faktur,
                "acc": acc
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6

            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'POST',
                url: "{{ url('otorisasi-transaksi') }}",
                data: data,
                dataType: "JSON",
                success: function() {
                    location.reload();
                    // toastr.error('Data berhasil dihapus', 'Berhasil');
                    //$('.tampildata').load("tampil.php");
                }
            });
        }
<<<<<<< HEAD

        function Hitung() {

            var total = $("#total").val();
            var bayar = $("#cash").val();
            var hasil = bayar - total.replace(/,/g, '');
            if (hasil < 0) {
                alert('pembayaran kurang');

                $('button').prop('disabled', true);
            } else {

                $('button').prop('disabled', false);
            }
            hasil = hasil.toString();
            $("#cash").val(formatRupiah(bayar));
            $("#kembalian").val(formatRupiah(hasil));
        }

        function Otorisasi(faktur, acc, totalharga = 0) {
            var data = {
                'faktur': faktur,
                "acc": acc

            }
            if (acc == 1) {
                $('button').prop('disabled', true);

                $("#hitung").modal('show');
                $("#total").val(formatRupiah(totalharga));
                $("#id_transaksi").val(faktur);
                $("#acc").val(acc);

                acc
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: "{{ url('otorisasi-transaksi') }}",
                    data: data,
                    dataType: "JSON",
                    success: function() {
                        location.reload();
                        // toastr.error('Data berhasil dihapus', 'Berhasil');
                        //$('.tampildata').load("tampil.php");
                    }
                });
            }

        }
=======
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
    </script>
@endsection
