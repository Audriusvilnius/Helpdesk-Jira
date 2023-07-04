<section id="alert">
    <div class="col-lg-12">
        @if (\Session::has('success'))
            <h6 class="alert alert-success alert-dismissible fade show  message" role="alert">
                <p>{{ \Session::get('success') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </h6>
        @endif
    </div>
</section>
