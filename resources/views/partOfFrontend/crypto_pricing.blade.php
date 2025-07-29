<table class="table table-bordered tb-primary">
    <thead class="header-1">
        <tr>
            <th>Rank#</th>
            <th>Coin</th>
            <th>Price</th>
            <th>Market Cap</th>
            <th>Change (24Hr)</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($prices as $v)
            @php
                /* echo "<pre>";
                print_r($v);die; */
                $day = $v?->delta?->day;
                $percentageChange = ($day - 1) * 100;
            @endphp
            <tr>
                <td style='width:10%; word-break: break-all;'>{{ $v->rank }} </td>
                <td style='width:30%; word-break: break-all;'>
                    <a href="{{ $v?->links?->website }}" target="_blank">
                        <div class="item-logo-wrap align-items-center">
                            <div class="">
                                <div class="intersection-visible-wrapper">
                                    <img class="bordered-img" src="{{$v?->png64}}" alt="{{ $v?->code; }} price logo"  width="30" height="30">
                                </div>
                            </div>
                            <div class="item-name">
                                <div class="filter-item-name text-left">{{ $v?->code; }}&nbsp;</div>
                                <small class="abr text-truncate text-left">{{ $v?->name; }}</small>
                            </div>
                        </div>
                    </a>
                </td>
                <td style='width:20%; word-break: break-all;'> ${{ number_format_short($v->rate,3)  }}</td>
                <td style='width:20%; word-break: break-all;'> ${{ number_format_short($v->cap,3)  }}</td>
                <td style='width:20%; word-break: break-all;' class="{{$percentageChange > 0 ? 'text-success' : 'text-danger'}}"> {{ number_format($percentageChange,2) }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
