@csrf

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="recruitment">Tema Recruitment</label>
  <div class="col-sm-12 col-md-7">
    <select id="recruitment" class="form-control" style="width: 100%" name="recruitment" readonly>
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
      <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" @isset($criteria) value="{{ old('name') ?? $criteria->name }}" @endisset />
      @error('name')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
      @enderror
  </div>
</div>

<div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="type">Jenis</label>
    <div class="col-sm-12 col-md-7">
        <select id="type" class="form-control @error('type') is-invalid @enderror" style="width: 100%" name="type">
            <option selected disabled>Pilih Jenis</option>
            <option @isset($criteria) {{ ($criteria->type == 'Benefit' ? 'selected' : '') }} @endisset value="Benefit">Benefit</option>
            <option @isset($criteria) {{ ($criteria->type == 'Cost' ? 'selected' : '') }} @endisset value="Cost">Cost</option>
        </select>
        @error('type')
            <span class="invalid-feedback" role="alert">
                <small>{{ $message }}</small>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row mb-4">
  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="weight">Bobot</label>
  <div class="col-sm-12 col-md-7">
      <input type="number" id="weight" min="1" class="form-control @error('weight') is-invalid @enderror" name="weight" @isset($criteria) value="{{ old('weight') ?? $criteria->weight * 100 }}" @else max="{{ 100 - $recruitment->criterias->sum('weight') * 100 }}" placeholder="Nilai Maksimum {{ 100 - $recruitment->criterias->sum('weight') * 100 }}" {{ ( $recruitment->criterias->sum('weight') == 1 ? 'disabled' : '') }} @endisset />
      @error('weight')
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
