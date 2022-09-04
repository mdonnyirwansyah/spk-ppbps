@csrf

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Recruitment</label>
    <div class="col-sm-12 col-md-7">
        <select class="form-control" style="width: 100%" name="recruitment" readonly>
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
        <select class="form-control" style="width: 100%" name="criteria" readonly>
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
      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" @isset($subCriteria) value="{{ $subCriteria->name }}" @endisset />
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
      <select class="form-control @error('rating') is-invalid @enderror" style="width: 100%" name="rating">
            <option selected disabled>Pilih Rating</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Sangat Tinggi' ? 'selected' : '') }} @endisset value="Sangat Tinggi">Sangat Tinggi</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Tinggi' ? 'selected' : '') }} @endisset value="Tinggi">Tinggi</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Cukup' ? 'selected' : '') }} @endisset value="Cukup">Cukup</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Rendah' ? 'selected' : '') }} @endisset value="Rendah">Rendah</option>
            <option @isset($subCriteria) {{ ($subCriteria->rating == 'Sangat Rendah' ? 'selected' : '') }} @endisset value="Sangat Rendah">Sangat Rendah</option>
      </select>
      @error('rating')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
    </div>
</div>

<div class="form-group row mb-4">
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
