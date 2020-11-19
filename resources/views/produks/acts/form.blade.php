@csrf
<input type="hidden" name="produk_id" value="{{ $produk -> id }}"/>
<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-5 form-control-label">
        <label>Pilih Aktivitas Usaha</label>
    </div>
    <div class="col-sm-6">
        <select name="act_id" class="form-control show-tick" data-live-search="true">
            @foreach($act as $a)
                <option value="{{ $a->id }}" {{ request('aid')==$a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row clearfix" id="kuantitasRes">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-5 form-control-label">
        <label>Frekuensi Pengulangan</label><br>
        <small>(per unit yang diproduksi)</small>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_frq" name="frekuensi" class="form-control" min="1" value="1" required/>
            </div>
            <small>Minimal 1</small>
        </div>
    </div>
</div>
