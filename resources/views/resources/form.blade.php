@csrf
<input type="hidden" name="usaha_id" value="{{ session('u') }}"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Resource</label>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan jenis resource" value="{{ $resource -> nama }}" required/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Umur Ekonomis</label>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="form-line">
                <input type="number" name="umur" class="form-control" placeholder="1" min="1" step="any" value="{{ $resource -> umur ?? 1}}" required/>
            </div>
            <small>Minimal 1 Tahun | Desimal dipisahkan dengan tanda titik | Contoh: 1.5</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Biaya Satuan (Rp)</label>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="form-line">
                <input type="text" id="rupiah" name="biaya" class="form-control" placeholder="12,000.25" value="{{ $resource -> biaya }}" required/>
            </div>
            <small>Selama umur ekonomis</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Kuantitas</label><br>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <div class="form-line">
                <input type="number" name="kuantitas" class="form-control" placeholder="1" min="1" value="{{ $resource -> kuantitas ?? 1}}" required/>
            </div>
            <small>Minimal 1</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Deskripsi</label>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
        <div class="form-line">
            <textarea name="deskripsi" rows="3" class="form-control no-resize">{{ $resource -> deskripsi }}</textarea>
        </div>
    </div>
</div>
