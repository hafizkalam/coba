<table class="table table-image">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total Harga</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qty = $harga = $totalHarga = 0;
        ?>
        @foreach ($tmp as $value)
            <?php
            $qty += $value->qty;
            $harga += $value->menu->harga;
            $totalHarga += $value->menu->harga * $value->qty;
            ?>

            <tr>
                <td style="vertical-align: middle;">{{ $value->menu->name }} </td>
                <td style="vertical-align: middle;">Rp {{ number_format($value->menu->harga) }}
                </td>
                <td>
                    <div class="form-inline">
                        <div class="form-group mb-2">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-secondary btn-number"
                                    onClick="jumlah('jumlah{{ $value->menu->id }}','{{ $value->menu->id }}','kurang')"
                                    data-type="minus" style="background-color:#ec2727; color: white;">-</button>
                            </div>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control text-center" id="jumlah{{ $value->id }}"
                                value="{{ $value->qty }}">
                        </div>

                        <div class="form-group mb-2">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary btn-number"
                                    style="background-color:#ec2727; color: white;"
                                    onClick="jumlah('jumlah{{ $value->menu->id }}','{{ $value->menu->id }}','tambah')"
                                    data-type="plus">+</button>
                            </div>
                        </div>

                    </div>



                </td>
                <td style="vertical-align: middle;">Rp
                    {{ number_format($value->menu->harga * $value->qty) }}</td>

                <td style="vertical-align: middle;" class="qty">
                    <input type="text" class="form-control" id="notes{{ $value->id }}"
                        onBlur="UpdateNotes('{{ $value->id }}')">
                </td>
                <td style="vertical-align: middle;">
                    <button class="btn btn-danger btn-sm"
                        onclick="DeleteDataKeranjang('{{ $value->no_transaksi }}','{{ $value->id_menu }}')">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <th style="vertical-align: middle;">Rp {{ number_format($harga) }}</th>
            <th style="vertical-align: middle;">{{ number_format($qty) }}</th>
            <th style="vertical-align: middle;">Rp {{ number_format($totalHarga) }}</th>
            <th colspan="2"></th>
        </tr>
    </tfoot>

</table>
