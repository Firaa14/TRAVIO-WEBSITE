<nav class="navbar navbar-expand-lg position-absolute w-100 top-0 start-0"
    style="background: rgba(0,0,0,0); z-index:30; border:none; box-shadow:none;">
    <div class="container-fluid px-5 py-2" style="margin:0; padding:0 2.5rem; min-height:80px; background:transparent;">
        <a class="navbar-brand d-flex align-items-center" href="/" style="padding:0;">
            <img src="/photos/logo-travio.png" alt="Travio Logo" style="width:110px; height:65px; object-fit:contain;">
        </a>

        <!-- Desktop Menu - langsung tampil di samping logo -->
        <ul class="navbar-nav ms-auto d-none d-lg-flex flex-row gap-4 align-items-center" style="margin:0; padding:0;">
            <li class="nav-item" style="padding:0;">
                <a class="nav-link text-white fw-bold position-relative @if(request()->path() == '/' || request()->path() == 'dashboard') active @endif"
                    aria-current="page" href="/dashboard" style="font-family:'Roboto',sans-serif; font-size:16px;">Home
                    @if(request()->path() == '/' || request()->path() == 'dashboard')
                        <span
                            style="position:absolute;left:50%;transform:translateX(-50%);bottom:-4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                    @endif
                </a>
            </li>
            <li class="nav-item" style="padding:0;">
                <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'planning') active @endif"
                    aria-current="page" href="/planning"
                    style="font-family:'Roboto',sans-serif; font-size:16px;">Planning
                    @if(request()->path() == 'planning')
                        <span
                            style="position:absolute;left:50%;transform:translateX(-50%);bottom:-4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                    @endif
                </a>
            </li>
            <li class="nav-item" style="padding:0;">
                <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'opentrip') active @endif"
                    aria-current="page" href="/opentrip" style="font-family:'Roboto',sans-serif; font-size:16px;">Open
                    Trip
                    @if(request()->path() == 'opentrip')
                        <span
                            style="position:absolute;left:50%;transform:translateX(-50%);bottom:-4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                    @endif
                </a>
            </li>
            <li class="nav-item" style="padding:0;">
                <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'gallery') active @endif"
                    aria-current="page" href="/gallery" style="font-family:'Roboto',sans-serif; font-size:16px;">Gallery
                    @if(request()->path() == 'gallery')
                        <span
                            style="position:absolute;left:50%;transform:translateX(-50%);bottom:-4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                    @endif
                </a>
            </li>
            <li class="nav-item" style="padding:0;">
                <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'profile') active @endif"
                    aria-current="page" href="/profile" style="font-family:'Roboto',sans-serif; font-size:16px;">Profile
                    @if(request()->path() == 'profile')
                        <span
                            style="position:absolute;left:50%;transform:translateX(-50%);bottom:-4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                    @endif
                </a>
            </li>
        </ul>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
            style="background: rgba(255,255,255,0.1);">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <!-- Mobile Menu (Collapsible) -->
        <!-- Mobile Menu (Collapsible) -->
        <div class="collapse navbar-collapse d-lg-none" id="navbarNav">
            <ul class="navbar-nav ms-4 gap-2 mt-3" style="margin:0; padding:0;">
                <li class="nav-item" style="padding:0;">
                    <a class="nav-link text-white fw-bold position-relative @if(request()->path() == '/' || request()->path() == 'dashboard') active @endif"
                        aria-current="page" href="/dashboard"
                        style="font-family:'Roboto',sans-serif; font-size:16px; padding: 8px 0;">Home
                        @if(request()->path() == '/' || request()->path() == 'dashboard')
                            <span
                                style="position:absolute;left:0;bottom:4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item" style="padding:0;">
                    <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'planning') active @endif"
                        aria-current="page" href="/planning"
                        style="font-family:'Roboto',sans-serif; font-size:16px; padding: 8px 0;">Planning
                        @if(request()->path() == 'planning')
                            <span
                                style="position:absolute;left:0;bottom:4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item" style="padding:0;">
                    <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'opentrip') active @endif"
                        aria-current="page" href="/opentrip"
                        style="font-family:'Roboto',sans-serif; font-size:16px; padding: 8px 0;">Open Trip
                        @if(request()->path() == 'opentrip')
                            <span
                                style="position:absolute;left:0;bottom:4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item" style="padding:0;">
                    <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'gallery') active @endif"
                        aria-current="page" href="/gallery"
                        style="font-family:'Roboto',sans-serif; font-size:16px; padding: 8px 0;">Gallery
                        @if(request()->path() == 'gallery')
                            <span
                                style="position:absolute;left:0;bottom:4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-item" style="padding:0;">
                    <a class="nav-link text-white fw-bold position-relative @if(request()->path() == 'profile') active @endif"
                        aria-current="page" href="/profile"
                        style="font-family:'Roboto',sans-serif; font-size:16px; padding: 8px 0;">Profile
                        @if(request()->path() == 'profile')
                            <span
                                style="position:absolute;left:0;bottom:4px;width:32px;height:2px;background:#fff;display:block;border-radius:1px;"></span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>