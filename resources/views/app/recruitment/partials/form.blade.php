<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="title">Judul</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" class="form-control" name="title" id="title" @isset($recruitment) value="{{ $recruitment->title }}" @endisset />
      <small class="invalid-feedback title_err"></small>
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
