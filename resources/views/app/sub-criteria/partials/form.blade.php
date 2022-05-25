<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="criteria">Kriteria</label>
    <div class="col-sm-12 col-md-7">
      <select class="form-control" style="width: 100%" name="criteria" id="criteria">
        @isset($subCriteria)
        @if ($subCriteria->criteria_id === null)
            <option value="" selected>Pilih Kriteria</option>
        @endif
        @else
        <option value="" selected>Pilih Kriteria</option>
        @endisset
        @foreach ($criteria as $item)
        <option value="{{ $item->id }}" @isset($subCriteria) @if ($subCriteria->criteria_id == $item->id) selected @endif @endisset>{{ $item->name }}</option>
        @endforeach
      </select>
      <small class="invalid-feedback criteria_err"></small>
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
        <option value="" selected>Pilih Rating</option>
        <option value="Sangat Tinggi">Sangat Tinggi</option>
        <option value="Tinggi">Tinggi</option>
        <option value="Cukup">Cukup</option>
        <option value="Rendah">Rendah</option>
        <option value="Sangat Rendah">Sangat Rendah</option>
      </select>
      <small class="invalid-feedback rating_err"></small>
    </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
  <div class="col-sm-12 col-md-7">
    <button class="btn btn-primary" id="btn">
      @isset($title)
        Simpan Perubahan
      @else
        Submit
      @endisset
    </button>
  </div>
</div>
