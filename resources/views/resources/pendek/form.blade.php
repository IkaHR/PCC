@csrf
<input type="hidden" name="usaha_id" value="{{ session('u') }}"/>
<input type="hidden" name="jenis" value="2"/>
<input type="hidden" name="umur" value="1"/>
<input type="hidden" name="kuantitas" value="1"/>
<input type="hidden" name="perawatan" value="0"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Resource</label>
    </div>
    <div class="col-sm-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama resource" value="{{ $resource -> nama }}" required/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Anggaran Per Tahun</label>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_currency" name="biaya" class="form-control" placeholder="12,000.25" value="{{ $resource -> biaya }}" required/>
            </div>
            <small>Biaya dikeluarkan pertahun untuk memenuhi kebutuhan resource</small>
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
