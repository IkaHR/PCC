@csrf
<input type="hidden" name="act_id" value="{{ $act -> id }}"/>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-5 form-control-label">
        <label>Pilih Resource</label>
    </div>
    <div class="col-sm-6">
        <select name="resource_id" class="form-control show-tick" data-live-search="true">
            @foreach($resource as $r)
                <option value="{{ $r->id }}" {{ request('rid')==$r->id ? 'selected' : '' }}>{{ $r->nama }} ({{ $r->kuantitas }} unit)</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-5 form-control-label">
        <label>Kuantitas resource yang digunakan</label><br>
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
