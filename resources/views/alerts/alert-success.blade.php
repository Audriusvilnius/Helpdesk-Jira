<section id="alert">
    <div class="col-lg-12">
        @if(\Session::has('success'))
        <h6 class="alert alert-success alert-dismissible fade show  message" role="alert">
            <p>{{ \Session::get('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </h6>
        @endif
    </div>
</section>


{{-- @if (\Session::has('success'))
 <div class="alert alert-success">
     <p>{{ \Session::get('success') }}</p>
</div>
@endif --}}

{{-- @if (count($errors) > 0)
 <div class="alert alert-danger">
     <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
     <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}
