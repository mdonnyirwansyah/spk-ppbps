<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Tema Recruitment</label>
  <div class="col-sm-12 col-md-7">
    <select class="form-control" style="width: 100%" name="recruitment" id="recruitment" readonly>
        @isset($candidate)
            <option value="{{ $candidate->recruitment_id }}" selected>{{ $candidate->recruitment->title }}</option>
        @else
            <option value="{{ $recruitment->id }}" selected>{{ $recruitment->title }}</option>
        @endisset
    </select>
  </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="name">Nama</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" class="form-control" name="name" id="name" @isset($candidate) value="{{ $candidate->name }}" @endisset />
      <small class="invalid-feedback name_err"></small>
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
