{{-- <table border="1">
    <tr>
        <th>Nama Tenant</th>

        @foreach ($tenant as $value)
            <tr>
                <td>
                <?php echo $value->name_tenant ?>
                </td>

            </tr>
        @endforeach
    </table>
<table border="1">
<tr>
    <th>Nama Tenant</th>
    <th>Nama Menu</th>
        <th>Harga Menu</th>
        <th>Deskripsi Menu</th>
    </tr>
    @foreach ($data as $value)
        <tr>
            <td>
            <?php echo $value->name_tenant ?>
            </td>
            <td>
            <?php echo $value->name_menu ?>
            </td>
            <td>
                <?php echo $value->harga_menu ?>
            </td>
            <td>
                <?php echo $value->desc_menu ?>
            </td>
        </tr>
    @endforeach
</table>
<p>Nomer Meja Anda Adalah {{request()->id;  }}</p>
 --}}
