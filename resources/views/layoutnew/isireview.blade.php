@foreach ($data as $value)
    <div class="modal-body text-start text-black p-4">
        <h5 class="card-title">{{ $value['nama_pemesan'] }}</h5>
        <div>
            <div class="rating">
                <span class="ml-2"> {{ date('d-m-Y', strtotime($value['tgl'])) }}</span>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $value['rating'])
                        <span class="star active" title="4">&#9733;</span>
                    @else
                        <span class="star" title="4">&#9733;</span>
                    @endif
                @endfor
            </div>
        </div>
        <p class="card-text">
            {{ $value['ulasan'] }}
        </p>

        <hr>
    </div>
@endforeach

<script>
    $('#loading-indicator').hide();
</script>
