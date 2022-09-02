<div class="tab-pane fade" id="matriks" role="tabpanel" aria-labelledby="matriks-tab">
    <table id="matriks-table" class="table table-bordered table-striped dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @foreach ($recruitment->criterias as $criteria)
                    <th>{{ $criteria->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach ($candidates as $index => $candidate)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $candidate->name }}</td>
                @foreach ($recruitment->criterias as $criteria)
                    <td>
                        @foreach ($criteria->sub_criterias as $sub_criteria)
                            @foreach ($candidate->assessments as $assessment)
                                {{ ($criteria->id == $assessment->criteria_id &&
                                $sub_criteria->weight == $assessment->weight) ? $assessment->weight : '' }}
                            @endforeach
                        @endforeach
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
