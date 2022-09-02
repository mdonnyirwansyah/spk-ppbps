<div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
    <div class="table-responsive">
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
                @foreach ($sawResults as $index => $result)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$result['name']}}</td>
                        @foreach ($result['criteria'] as $key => $criteria)
                            <td>
                                {{$criteria['result']}}
                            </td>
                        @endforeach
                        <td>
                            {{$result['score']}}
                        </td>
                        <form action="{{ route('candidate.update-status', $result['slug']) }}" id="form-update-status" enctype="multipart/form-data">
                            @method('PUT')
                            <td>
                                <select class="form-control" style="width: 100%" name="status">
                                    <option selected disabled>Pilih</option>
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" id="btn" data-toggle="tooltip" data-placement="top" title="Simpan" class="btn btn-icon">
                                    <i class="fas fa-save text-primary"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
