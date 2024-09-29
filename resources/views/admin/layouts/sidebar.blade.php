<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            {{-- <a href="{{ route('home') }}">{{ $setting->site_name }}</a> --}}
        </div>

        <ul class="sidebar-menu">


            {{-- ___________________________ ratings __________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ __('Ratings') }}</li>
            {{-- settings____________________________________________________________________________ --}}
            <li class="{{ setActive(['admin.rating.*']) }}"><a href="{{ route('admin.rating.index') }}"
                    class="nav-link "><i class="fas fa-wrench"></i><span>{{ __('Ratings') }}</span></a></li>

            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ 'Persons' }}</li>

            <li class="{{ setActive(['admin.teacher.*']) }}"><a href="{{ route('admin.teacher.index') }}"
                    class="nav-link "><i class="fas fa-cog"></i><span>{{ __('Teachers') }}</span></a></li>

            <li class="{{ setActive(['admin.student.*']) }}"><a href="{{ route('admin.student.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Students') }}</span></a></li>

            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ __('Materials') }}</li>

            <li class="{{ setActive(['admin.track.*']) }}"><a href="{{ route('admin.track.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Education tracks') }}</span></a>
            </li>

            <li class="{{ setActive(['admin.class.*']) }}"><a href="{{ route('admin.class.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Classes') }}</span></a>
            </li>

            <li class="{{ setActive(['admin.class-room.*']) }}"><a href="{{ route('admin.class-room.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Class rooms') }}</span></a>
            </li>

            <li class="{{ setActive(['admin.material.*']) }}"><a href="{{ route('admin.material.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Materials') }}</span></a>
            </li>

            <li class="{{ setActive(['admin.lesson.*']) }}"><a href="{{ route('admin.lesson.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Lessons') }}</span></a></li>

            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ __('Social media') }}</li>
            <li class="{{ setActive(['admin.socials.*']) }}"><a href="{{ route('admin.socials.index') }}"
                    class="nav-link "><i class="fab fa-facebook-square"></i>{{ __('Social media') }}</a></li>


            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>{{ __('Settings') }}</li>
            {{-- settings____________________________________________________________________________ --}}
            <li class="{{ setActive(['admin.settings.*']) }}"><a href="{{ route('admin.settings.index') }}"
                    class="nav-link "><i class="fas fa-wrench"></i><span>{{ __('Website settings') }}</span></a></li>

        </ul>

        <br>
        <br>

    </aside>
</div>
