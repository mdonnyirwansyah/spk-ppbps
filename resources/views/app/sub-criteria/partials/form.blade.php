<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Recruitment</label>
    <div class="col-sm-12 col-md-7">
        <select class="form-control" style="width: 100%" name="recruitment" id="recruitment" readonly>
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
        <select class="form-control" style="width: 100%" name="criteria" id="criteria" readonly>
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
      <input type="text" class="form-control" name="name" id="name" @isset($subCriteria) value="{{ $subCriteria->name }}" @endisset />
      <small class="invalid-feedback name_err"></small>
  </div>
</div>

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="rating">Rating</label>
    <div class="col-sm-12 col-md-7">
      <select class="form-control select2" style="width: 100%" name="rating" id="rating">
        @isset($subCriteria)
            <option value="Sangat Tinggi" class="@if ($subCriteria->rating == "Sangat Tinggi") d-none @endif" @if ($subCriteria->rating == "Sangat Tinggi") selected @endif>Sangat Tinggi</option>
            <option value="Tinggi" class="@if ($subCriteria->rating == "Tinggi") d-none @endif" @if ($subCriteria->rating == "Tinggi") selected @endif>Tinggi</option>
            <option value="Cukup" class="@if ($subCriteria->rating == "Cukup") d-none @endif" @if ($subCriteria->rating == "Cukup") selected @endif>Cukup</option>
            <option value="Rendah" class="@if ($subCriteria->rating == "Rendah") d-none @endif" @if ($subCriteria->rating == "Rendah") selected @endif>Rendah</option>
            <option value="Sangat Rendah" class="@if ($subCriteria->rating == "Sangat Rendah") d-none @endif" @if ($subCriteria->rating == "Sangat Rendah") selected @endif>Sangat Rendah</option>
        @else
            <option value="" selected>Pilih Rating</option>
            <option value="Sangat Tinggi">Sangat Tinggi</option>
            <option value="Tinggi">Tinggi</option>
            <option value="Cukup">Cukup</option>
            <option value="Rendah">Rendah</option>
            <option value="Sangat Rendah">Sangat Rendah</option>
        @endisset
      </select>
      <small class="invalid-feedback rating_err"></small>
    </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
  <div class="col-sm-12 col-md-7">
    <button class="btn btn-primary" id="btn">
      @isset($candidate)
        Simpan Perubahan
      @else
        Submit
      @endisset
    </button>
  </div>
</div>
