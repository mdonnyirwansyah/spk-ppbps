<div class="tab-pane fade show active" id="assessments" role="tabpanel" aria-labelledby="assessments-tab">
    <table id="assessments-table" class="table table-bordered table-striped dt-responsive nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @foreach ($recruitment->criterias as $criteria)
                    <th>{{ $criteria->name }}</th>
                @endforeach
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($recruitment->candidates as $index => $candidate)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $candidate->name }}</td>
                <form method="POST" action="{{ route('assessment.store') }}">
                    @csrf
                    <input type="hidden" name="recruitment_id" value="{{ $recruitment->id }}"/>
                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}"/>
                @foreach ($recruitment->criterias as $criteria)
                    <td>
                        <input type="hidden" name="criteria[]" value="{{ $criteria->id }}"/>
                        <select class="form-control" style="width: 100%" name="sub_criterias[]">
                            <option selected disabled>Pilih</option>
                            @foreach ($criteria->sub_criterias as $sub_criteria)
                            <option value="{{ $sub_criteria->weight }}"
                                @foreach ($candidate->assessments as $assessment)
                                    {{ ($criteria->id == $assessment->criteria_id &&
                                    $sub_criteria->weight == $assessment->weight) ? 'selected' : '' }}
                                @endforeach>
                                {{ $sub_criteria->name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                @endforeach
                <td>
                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Simpan" class="btn btn-icon">
                        <i class="fas fa-save text-primary"></i>
                    </button>
                </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
