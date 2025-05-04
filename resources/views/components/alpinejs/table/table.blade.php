
<table class="w-full">
    <caption>
        @if (isset($caption))
            {{ $caption }}
        @endif
    </caption>
    <thead>
        @if (isset($thead))
            <tr class="bg-gray-200 border-b">
                {{ $thead }}
            </tr>
        @endif
    </thead>
    <tbody>
        @if (isset($tbody))
            {{ $tbody }}
        @endif
    </tbody>
    <tfoot>
        @if (isset($tfoot))
            {{ $tfoot }}
        @endif
    </tfoot>
</table>
