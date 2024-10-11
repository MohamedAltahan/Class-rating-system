<div class="container main_header" style="padding:5% 0">

    <div class="row g-5 align-items-center flex-wrap-reverse">

        <div class="col-lg-6 text-center ">

            <div class="text-white mb-4 animated slideInDown px-2">
                {!! $homePageSetting->main_title !!}
            </div>
            <div class="text-white pb-3 animated slideInDown px-2">
                {!! $homePageSetting->description !!}
            </div>

            @if (!Auth::user())
                <a href="{{ route('login') }}"
                    class="btn btn_color text-dark py-sm-3 px-sm-5 rounded-pill me-3 mt-4 animated slideInLeft">
                    {{ __('Login and start rating') }}
                </a>
            @else
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.rating.material.allMaterialRatings') }}"
                        class="btn btn_color text-dark py-sm-3 px-sm-5 rounded-pill me-3 mt-4 animated slideInLeft">
                        {{ __('Dashboard') }}
                    </a>
                @elseif (Auth::user()->role === 'student')
                    <a href="{{ route('rating.index') }}"
                        class="btn btn_color text-dark py-sm-3 px-sm-5 rounded-pill me-3 mt-4 animated slideInLeft">
                        {{ __('Dashboard') }}
                    </a>
                @endif
            @endif
        </div>

        <div class="col-md-5 col-md-5 animated  slideInRight ">
            <img class=" animated  fadeIn img-fluid wow" data-wow-delay="0.3s" height="600px"
                style="background-size: cover" src="{{ asset('uploads/' . $homePageSetting->image) }}" alt="">
        </div>


    </div>
</div>
