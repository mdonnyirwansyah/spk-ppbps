<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Tema Recruitment</label>
  <div class="col-sm-12 col-md-7">
    <select class="form-control" style="width: 100%" name="recruitment" id="recruitment" readonly>
        @isset($criteria)
            <option value="{{ $criteria->recruitment_id }}" selected>{{ $criteria->recruitment->title }}</option>
        @else
        <option value="{{ $recruitment->id }}" selected>{{ $recruitment->title }}</option>
        @endisset
    </select>
  </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">Nama</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" class="form-control" name="name" id="name" @isset($criteria) value="{{ $criteria->name }}" @endisset />
      <small class="invalid-feedback name_err"></small>
  </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="weight">Bobot</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" class="form-control" name="weight" id="weight" @isset($criteria) value="{{ $criteria->weight }}" @endisset />
      <small class="invalid-feedback weight_err"></small>
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
