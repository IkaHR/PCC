@csrf
<input type="hidden" name="act_id" value="{{ $act -> id }}"/>
<input type="hidden" name="kuantitas" value="1"/>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
        <label>Pilih Resource</label>
    </div>
    <div class="col-sm-6">
        <select name="resource_id" class="form-control show-tick" data-live-search="true">
            @foreach($r2 as $r)
                <option value="{{ $r->id }}" {{ request('rid')==$r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
