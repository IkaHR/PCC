@csrf
<input type="hidden" name="act_id" value="{{ $act -> id }}"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Deskripsi SubAktivitas</label>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
        <div class="form-line">
            <textarea name="detail" rows="2" class="form-control no-resize" required>{{ $sub -> detail }}</textarea>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Index</label><br>
    </div>
    <div class="col-md-3">
        <div class="input-group form-group-lg">
            <div class="form-line">
                <input type="text" id="input_mask_idx" name="idx" class="form-control" placeholder="1" min="1" value="{{ $sub -> idx ?? 1}}" required/>
            </div>
            <small>Minimal 1</small>
        </div>
    </div>
</div>
