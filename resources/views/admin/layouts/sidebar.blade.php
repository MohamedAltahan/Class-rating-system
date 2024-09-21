<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            {{-- <a href="{{ route('home') }}">{{ $setting->site_name }}</a> --}}
        </div>

        <ul class="sidebar-menu">


            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>الاعدادت</li>
            {{-- settings____________________________________________________________________________ --}}
            <li class="{{ setActive(['admin.settings.*']) }}"><a href="{{ route('admin.settings.index') }}"
                    class="nav-link "><i class="fas fa-wrench"></i><span>إعدادات الموقع</span></a></li>

            {{-- <li class="{{ setActive(['admin.sub-category.*']) }}"><a href="{{ route('admin.sub-category.index') }}"
                        class="nav-link "><i class="fas fa-cog"></i><span>SubCategories</span></a></li> --}}

            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>الأشخاص</li>

            <li class="{{ setActive(['admin.teacher.*']) }}"><a href="{{ route('admin.teacher.index') }}"
                    class="nav-link "><i class="fas fa-cog"></i><span>{{ __('Teachers') }}</span></a></li>

            <li class="{{ setActive(['admin.show-designs.*', 'admin.design.*']) }}"><a
                    href="{{ route('admin.show-designs.index') }}" class="nav-link "><i
                        class="fas fa-pen-fancy"></i><span>{{ __('Students') }}</span></a></li>

            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>المواد التعلمية</li>

            <li class="{{ setActive(['admin.track.*']) }}"><a href="{{ route('admin.track.index') }}"
                    class="nav-link "><i class="fas fa-pen-fancy"></i><span>{{ __('Education tracks') }}</span></a>
            </li>

            <li class="{{ setActive(['admin.show-designs.*', 'admin.design.*']) }}"><a
                    href="{{ route('admin.show-designs.index') }}" class="nav-link "><i
                        class="fas fa-pen-fancy"></i><span>الصفوف</span></a></li>

            <li class="{{ setActive(['admin.show-designs.*', 'admin.design.*']) }}"><a
                    href="{{ route('admin.show-designs.index') }}" class="nav-link "><i
                        class="fas fa-pen-fancy"></i><span>المواد التعلمية</span></a></li>

            <li class="{{ setActive(['admin.show-designs.*', 'admin.design.*']) }}"><a
                    href="{{ route('admin.show-designs.index') }}" class="nav-link "><i
                        class="fas fa-pen-fancy"></i><span>الحصص</span></a></li>
            {{-- ___________________________setting__________________________________________________ --}}
            <li class="menu-header" style="color: black"> </i>التواصل الاجتماعي</li>
            <li class="{{ setActive(['admin.socials.*']) }}"><a href="{{ route('admin.socials.index') }}"
                    class="nav-link "><i class="fab fa-facebook-square"></i><span>مواقع التواصل</span></a></li>
        </ul>

        <br>
        <br>

    </aside>
</div>
