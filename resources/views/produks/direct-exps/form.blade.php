@csrf
<input type="hidden" name="produk_id" value="{{ $produk -> id }}"/>
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-5 form-control-label">
        <label>Pilih Data Pengeluaran</label>
    </div>
    <div class="col-sm-6">
        <select name="direct_id" class="form-control show-tick" data-live-search="true">
            @foreach($direct as $d)
                <option value="{{ $d->id }}" {{ request('did')==$d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-5 form-control-label">
        <label>Kuantitas yang perlukan</label><br>
        <small>(per produksi)</small>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_unit_number" name="kuantitas" class="form-control" min="1" value="1" required/>
            </div>
            <small>Minimal 1</small>
        </div>
    </div>
</div>
