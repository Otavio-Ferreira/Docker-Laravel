<table class="table {{ isset($tableClass) ? $tableClass : '' }}" id="{{ isset($tableId) ? $tableId : '' }}">
    <thead>
        <tr>
            {!! isset($ths) ? $ths : '' !!}
        </tr>
    </thead>
    <tbody>
        {!! isset($trs) ? $trs : '' !!}
    </tbody>
</table>
