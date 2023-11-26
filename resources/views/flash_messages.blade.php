@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session()->get('message') }}
  </div>
@endif

@if(session()->has('status'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session()->get('status') }}
  </div>
@endif
