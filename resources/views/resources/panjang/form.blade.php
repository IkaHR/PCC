@csrf
<input type="hidden" name="usaha_id" value="{{ session('u') }}"/>
<input type="hidden" name="jenis" value="1"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Resource</label>
    </div>
    <div class="col-sm-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan jenis resource" value="{{ $resource -> nama }}" required/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Lama Penggunaan</label>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_economic_age" name="umur" class="form-control" placeholder="1" min="1" step="any" value="{{ $resource -> umur ?? 1}}" required/>
            </div>
            <small>Untuk satuan bulan, gunakan angka desimal | Contoh: 1.5 tahun</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Biaya Per Unit</label>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_currency_unit" name="biaya" class="form-control" placeholder="12,000.25" value="{{ $resource -> biaya }}" required/>
            </div>
            <small>Selama umur ekonomis</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Biaya Perawatan Unit / Tahun</label>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_currency_perawatan" name="perawatan" class="form-control" placeholder="12,000.25" value="{{ $resource -> perawatan }}" />
            </div>
            <small>Opsional</small>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Kuantitas</label><br>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_unit_number" name="kuantitas" class="form-control" min="1" value="{{ $resource -> kuantitas ?? 1 }}" required/>
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
