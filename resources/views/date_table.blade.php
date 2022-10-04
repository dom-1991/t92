<table class="table table-bordered font-weight-bold text-center">
    <tr>
        @for($i = 0; $i <= 30; $i++)
            @php
                $i = ($i < 10 ? '0' : '') . $i
            @endphp
            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
        @endfor
    </tr>
    <tr>
        @for($i = 31; $i <= 61; $i++)
            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
        @endfor
    </tr>
    <tr>
        @for($i = 61; $i <= 91; $i++)
            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
        @endfor
    </tr>
    <tr>
        @for($i = 91; $i <= 99; $i++)
            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
        @endfor
    </tr>
</table>
