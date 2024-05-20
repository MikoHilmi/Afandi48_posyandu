<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('antrian.index') ? '' : 'collapsed' }}" href="{{ route('antrian.index') }}">
                <i class="bi bi-123"></i>
                <span>Antrian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('orang-tua.*') ? '' : 'collapsed' }}" href="{{ route('orang-tua.index') }}">
                <i class="bi bi-person"></i>
                <span>Orang Tua</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('balita.*', 'imunisasi.*') ? '' : 'collapsed' }}"
                href="{{ route('balita.index') }}">
                <i class="bi bi-person-hearts"></i>
                <span>Data Balita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('vaksin.*', 'vaksin-transaksi.*') ? '' : 'collapsed' }}"
                data-bs-target="#vaksin" data-bs-toggle="collapse" href="#">
                <i class="bi bi-shield"></i><span>Daftar Vaksin</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="vaksin" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('vaksin.index') ? '' : 'collapsed' }}"
                        href="{{ route('vaksin.index') }}">
                        <i class="bi bi-shield"></i>
                        <span>Data Vaksin</span>
                    </a>
                </li>
            </ul>
            <ul id="vaksin" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('vaksin-transaksi.*') ? '' : 'collapsed' }}"
                        href="{{ route('vaksin-transaksi.index') }}">
                        <i class="bi bi-shield"></i>
                        <span>Transaksi Vaksin</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('vitamin.*', 'vitamin-transaksi.*') ? '' : 'collapsed' }}"
                data-bs-target="#vitamin" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bandaid"></i><span>Daftar Vitamin</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="vitamin" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('vitamin.index') ? '' : 'collapsed' }}"
                        href="{{ route('vitamin.index') }}">
                        <i class="bi bi-bandaid"></i>
                        <span>Data Vitamin</span>
                    </a>
                </li>
            </ul>
            <ul id="vitamin" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('vitamin-transaksi.index') ? '' : 'collapsed' }}"
                        href="{{ route('vitamin-transaksi.index') }}">
                        <i class="bi bi-bandaid"></i>
                        <span>Transaksi Vitamin</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('kegiatan.*') ? '' : 'collapsed' }}" href="{{ route('kegiatan.index') }}">
                <i class="bi bi-clock"></i>
                <span>Jadwal Kegiatan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('kader.*') ? '' : 'collapsed' }}" href="{{ route('kader.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Kader</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('laporan.index') ? '' : 'collapsed' }}"
                href="{{ route('laporan.index') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('user.*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                <i class="bi bi-person-gear"></i>
                <span>Pengguna</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.settings') ? '' : 'collapsed' }}"
                href="{{ route('admin.settings') }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>
</aside>
