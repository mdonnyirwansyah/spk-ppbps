<table cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle;">Rank.</th>
            <th rowspan="2" style="vertical-align: middle;">Nama</th>
            <th colspan="{{ $recruitment->criterias->count() }}" style="text-align: center;">Kriteria</th>
            <th rowspan="2" style="vertical-align: middle;">Skor</th>
            <th rowspan="2" style="vertical-align: middle;">Status</th>
        </tr>
        <tr>
            @foreach ($recruitment->criterias as $criteria)
                <th>{{ $criteria->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($sawResults as $index => $result)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $result['name'] }}</td>
                @foreach ($result['criteria'] as $key => $criteria)
                    <td>
                        {{ $criteria['result'] }}
                    </td>
                @endforeach
                <td>
                    {{ $result['score'] }}
                </td>
                <td>{{ $result['status'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
