@csrf

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="title">Judul</label>
  <div class="col-sm-12 col-md-7">
      <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $recruitment->title ?? '' }}" />
      @error('title')
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
      @isset($recruitment)
        Simpan Perubahan
      @else
        Submit
      @endisset
    </button>
  </div>
</div>
