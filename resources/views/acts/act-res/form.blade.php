@csrf
<input type="hidden" name="act_id" value="{{ $act -> id }}"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Pilih Resource</label>
    </div>
    <div class="col-sm-4">
        <select name="jenis" class="form-control show-tick" data-live-search="true">
            @foreach($res as $r)
                <option name="resource_id" value="{{ $r->id }}"
                    {{ $r->id == $act_res->resource_id ? 'selected' : '' }}>
                    {{ $r->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Kuantitas yang perlukan</label><br>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_unit_number" name="kuantitas" class="form-control" min="1" value="{{ $act_res -> kuantitas ?? 1 }}" required/>
            </div>
            <small>Minimal 1</small>
        </div>
    </div>
</div>
