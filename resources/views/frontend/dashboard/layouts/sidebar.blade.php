<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            {{-- <a href="{{ route('home') }}">{{ $setting->site_name }}</a> --}}
        </div>

        <ul class="sidebar-menu">


            {{-- ___________________________ ratings __________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ __('Ratings') }}</li>
            {{-- settings____________________________________________________________________________ --}}
            <li class="{{ setActive(['*']) }}"><a href="{{ route('rating.index') }}" class="nav-link "><i
                        class="fas fa-star"></i><span>{{ __('Ratings') }}</span></a></li>

        </ul>

        <br>
        <br>

    </aside>
</div>
