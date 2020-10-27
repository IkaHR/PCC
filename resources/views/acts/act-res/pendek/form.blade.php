@csrf
<input type="hidden" name="act_id" value="{{ $act -> id }}"/>
<input type="hidden" name="kuantitas" value="1"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Pilih Resource</label>
    </div>
    <div class="col-sm-4">
        <select name="jenis" class="form-control show-tick" data-live-search="true">
            @foreach($r2 as $r)
                <option name="resource_id" value="{{ $r->id }}"
                    {{ $r->id == $act_res->resource_id ? 'selected' : '' }}>
                    {{ $r->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>
