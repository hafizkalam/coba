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
                                        <th>No</th>
                                        <th>Pesanan</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>No Meja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($data as $value)
                                        <?php $no++; ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $value->pesanan }}</td>
                                            <td>{{ $value->tgl_transaksi }}</td>
                                            <td>{{ $value->tipe_pembayaran }}</td>
                                            <td>{{ $value->no_meja }}</td>
                                            <td>

                                                <button type="button" class="btn btn-primary float-right"
                                                    data-toggle="modal" data-target="#modal-edit">
                                                    Edit
                                                </button>
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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" id="saveEdit" enctype='multipart/form-data' action="transaksi">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Website</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Pesanan</label>
                            <div class="col-sm-11">
                                <input type="text" name="description" id="description" class="form-control">
                                <input type="text" name="pesanan" id="pesanan" class="d-none">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-light">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit" class="btn btn-primary">Save </button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script>
        $("#example1").DataTable();
        $('#example1 tbody').on('click', 'tr', function() {
            var table = $('#example1').DataTable();
            var data = table.row(this).data();
            $("#description").val(data[2]);
            $("#name").val(data[1]);
        });
    </script>
@endsection
