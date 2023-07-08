<section id="alert">
    <div class="col-lg-12">
        @if (count($errors) > 0)
            <h6 class="alert alert-danger alert-dismissible fade show  message" role="alert">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </h6>
        @endif
    </div>
</section>
