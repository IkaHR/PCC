@csrf
<input type="hidden" name="usaha_id" value="{{ session('u') }}"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Aktivitas</label>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama aktivitas" value="{{ $act -> nama }}" required/>
            </div>
        </div>
    </div>
</div>
