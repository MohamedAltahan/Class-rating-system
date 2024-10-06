<!-- Footer Start -->
<div>
    <div class="container-fluid main_header text-light rounded-top">
        <div class="container  ">
            <div class="row py-3">
                <div class="col-md-12  d-flex justify-content-center">

                    <div class="d-flex py-2">
                        @foreach ($socials as $social)
                            <a target="_blank" class="btn btn-outline-dark btn-social mx-1" href="{{ $social->link }}"><i
                                    class="{{ $social->icon }}"></i></a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
