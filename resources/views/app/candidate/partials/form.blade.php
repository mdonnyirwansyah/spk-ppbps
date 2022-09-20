@csrf

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Tema Recruitment</label>
  <div class="col-sm-12 col-md-7">
    <select id="recruitment" class="form-control" style="width: 100%" name="recruitment" readonly>
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
      <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" @isset($candidate) value="{{ old('name') ?? $candidate->name }}" @endisset />
      @error('name')
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
      @isset($candidate)
        Simpan Perubahan
      @else
        Submit
      @endisset
    </button>
  </div>
</div>
