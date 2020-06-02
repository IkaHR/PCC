@csrf
<input type="hidden" name="usaha_id" value="{{ session('u') }}">
<div class="row clearfix">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <label>Nama Nama</label>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama produk" value="{{ $resource -> nama }}" required>
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
            <textarea name="deskripsi" rows="3" class="form-control no-resize" placeholder="Opsional"> {{ $resource -> deskripsi }} </textarea>
        </div>
    </div>
</div>
