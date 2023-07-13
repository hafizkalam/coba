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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>No Meja</th>
                                        <th>Total</th>
                                        <th>Cara Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data as $value)
                                        <?php $no++; ?>
                                        <tr>
                                            <td>{{ $value['no_transaksi'] }}</td>
                                            <td>{{ $value['tgl_transaksi'] }}</td>
                                            <td>{{ $value['no_meja'] }}</td>
                                            <td>{{ number_format($value['total']) }}</td>
                                            <td><span class="badge badge-primary">{{ $value['cara_pembayaran'] }} </span>
                                            </td>
                                            <td> {{ $value['status_pembayaran'] }}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <th>Nama Menu</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                    @foreach ($value['detail'] as $value1)
                                                        <tr>
                                                            <td>{{ $menu[$value1['id_menu']]['name'] }}</td>
                                                            <td>{{ $value1['qty'] }}</td>
                                                            <td>{{ number_format($menu[$value1['id_menu']]['harga']) }}</td>
                                                            <td>{{ number_format($value1['total']) }}</td>
                                                            <td>{{ $value1['notes'] }}</td>
                                                        </tr>
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
@endsection

@section('script')
    <script>
        $("#example1").DataTable({
            responsive: true
        });
    </script>
@endsection
