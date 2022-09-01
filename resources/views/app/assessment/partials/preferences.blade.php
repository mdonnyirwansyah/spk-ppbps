<div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
    <table id="preferences-table" class="table table-bordered table-striped dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Nama</th>
                @foreach ($recruitment->criterias as $criteria)
                    <th>{{ $criteria->name }}</th>
                @endforeach
                <th>Skor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($recruitment->candidates as $index => $candidate)
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
                <td></td>
                <td>
                    <select class="form-control" style="width: 100%" name="status">
                        <option selected disabled>Pilih</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Tidak Lulus">Tidak Lulus</option>
                    </select>
                </td>
                <td>
                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Simpan" class="btn btn-icon">
                        <i class="fas fa-save text-primary"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
