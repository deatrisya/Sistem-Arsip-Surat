<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item ">
            <a class="nav-link {{ Route::is('arsip.*') ? 'active' : 'collapsed' }}" href="{{ route('arsip.index') }}">
                <i class="bi bi-folder"></i>
                <span>Arsip</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Route::is('kategori.*') ? 'active' : 'collapsed' }}" href="{{ route('kategori.index') }}">
                <i class="bi bi-tag"></i>
                <span>Kategori Surat</span>
            </a>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('about.*') ? 'active' : 'collapsed' }}" href="{{ route('about.index')}}">
                <i class="bi bi-info-circle"></i>
                <span>About</span>
            </a>
        </li><!-- End Components Nav -->

    </ul>

</aside><!-- End Sidebar-->
