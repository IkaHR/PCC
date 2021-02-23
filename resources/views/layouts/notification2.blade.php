@if (session()-> has('notif2'))
    <div class="alert bg-teal alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('notif2') }}
    </div>
@endif

@if (session()-> has('error2'))
    <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('error2') }}
    </div>
@endif

@if (session()-> has('warning2'))
    <div class="alert bg-orange alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('warning2') }}
    </div>
@endif

@if (session()-> has('success2'))
    <div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('success2') }}
    </div>
@endif
