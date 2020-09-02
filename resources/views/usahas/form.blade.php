@csrf
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Badan Usaha</label>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Badan Usaha" value="{{ $usaha -> nama }}" required/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>No. Telp</label>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="form-line">
                <input id="input_mask_number" type="text" name="phone" class="form-control" placeholder="Opsional" value="{{ $usaha -> phone }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Email</label>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="form-line">
                <input type="email" name="email" class="form-control" placeholder="Opsional" value="{{ $usaha -> email }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Alamat</label>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="alamat" class="form-control" placeholder="Opsional" value="{{ $usaha -> alamat }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Deskripsi</label>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
        <div class="form-line">
            <textarea name="deskripsi" rows="3" class="form-control no-resize" placeholder="Opsional"> {{ $usaha -> deskripsi }} </textarea>
        </div>
    </div>
</div>
