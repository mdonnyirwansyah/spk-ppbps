@csrf

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Recruitment</label>
    <div class="col-sm-12 col-md-7">
        <select id="recruitment" class="form-control" style="width: 100%" name="recruitment" readonly>
            @isset($subCriteria)
                <option value="{{ $subCriteria->criteria_id }}" selected>{{ $subCriteria->criteria->recruitment->title }}</option>
            @else
            <option value="{{ $criteria->recruitment->id }}" selected>{{ $criteria->recruitment->title }}</option>
            @endisset
        </select>
    </div>
</div>

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="criteria">Kriteria</label>
    <div class="col-sm-12 col-md-7">
        <select id="criteria" class="form-control" style="width: 100%" name="criteria" readonly>
            @isset($subCriteria)
                <option value="{{ $subCriteria->criteria_id }}" selected>{{ $subCriteria->criteria->name }}</option>
            @else
            <option value="{{ $criteria->id }}" selected>{{ $criteria->name }}</option>
            @endisset
        </select>
    </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">Nama</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $subCriteria->name ?? '' }}" />
      @error('name')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
  </div>
</div>

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="rating">Rating</label>
    <div class="col-sm-12 col-md-7">
      <select id="rating" class="form-control @error('rating') is-invalid @enderror" style="width: 100%" name="rating">
            <option selected disabled>Pilih Rating</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Sangat Tinggi' ? 'selected' : '') }} @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Sangat Tinggi' && $subCriteria->rating != 'Sangat Tinggi' ? 'disabled' : '') }} @endforeach @else @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Sangat Tinggi' ? 'disabled' : '') }} @endforeach @endisset value="Sangat Tinggi">Sangat Tinggi</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Tinggi' ? 'selected' : '') }} @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Tinggi' && $subCriteria->rating != 'Tinggi' ? 'disabled' : '') }} @endforeach @else @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Tinggi' ? 'disabled' : '') }} @endforeach @endisset value="Tinggi">Tinggi</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Cukup' ? 'selected' : '') }} @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Cukup' && $subCriteria->rating != 'Cukup' ? 'disabled' : '') }} @endforeach @else @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Cukup' ? 'disabled' : '') }} @endforeach @endisset value="Cukup">Cukup</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Rendah' ? 'selected' : '') }} @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Rendah' && $subCriteria->rating != 'Rendah' ? 'disabled' : '') }} @endforeach @else @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Rendah' ? 'disabled' : '') }} @endforeach @endisset value="Rendah">Rendah</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Sangat Rendah' ? 'selected' : '') }} @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Sangat Rendah' && $subCriteria->rating != 'Sangat Rendah' ? 'disabled' : '') }} @endforeach @else @foreach ($criteria->sub_criterias as $key) {{ ($key->rating == 'Sangat Rendah' ? 'disabled' : '') }} @endforeach @endisset value="Sangat Rendah">Sangat Rendah</option>
      </select>
      @error('rating')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
    </div>
</div>

<div class="form-group row">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
  <div class="col-sm-12 col-md-7">
    <button class="btn btn-primary">
      @isset($subCriteria)
        Simpan Perubahan
      @else
        Submit
      @endisset
    </button>
  </div>
</div>
