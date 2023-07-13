<div class="d-flex justify-content-between">
    <p class="fw-bold mb-0">No Pesanan</p>
    <p class="text-muted mb-0">{{ $noFaktur }}</p>
</div>

<?php
$total = 0;
?>
@foreach ($tmp as $value)
    <?php $total += $value->total; ?>
    <div class="d-flex justify-content-between">
        <p class="small mb-0">{{ $value->menu->name }}</p>
        <p class="small mb-0">{{ number_format($value->total) }}</p>
    </div>
@endforeach

<div class="d-flex justify-content-between">
    <p class="fw-bold">Total</p>
    <p class="fw-bold" style="color: #35558a;">{{ number_format($total) }}</p>
</div>

<div class="d-flex justify-content-center">

    <span class="badge badge-primary">Menuggu Otorisasi</span>
</div>
<script>
    setInterval(function() {
        console.log('oke');
    }, 3000);
</script>
