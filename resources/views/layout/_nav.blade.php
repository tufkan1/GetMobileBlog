<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route("app.index") }}">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav w-100 mb-2 mb-lg-0 align-items-center">
                @if(in_array('add_blogs', Arr::pluck($user['role']['permissions'], 'name')))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("app.create") }}">Blog Ekle</a>
                    </li>
                @endif
                @if(in_array('accept_blogs', Arr::pluck($user['role']['permissions'], 'name')))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("app.accept") }}">Onay Bekleyen Bloglar</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("user.logout") }}">Çıkış Yap</a>
                </li>
                <li class="nav-item ms-auto d-flex">
                    <img src="https://ui-avatars.com/api/?background=random&bold=true&background=E1F1F9&color=000&name={{ $user["name"] }}" class="rounded-pill me-3" width="50">
                    <div class="small">
                        <p class="mb-0">{{ $user["name"] }}</p>
                        <p class="mb-0">{{ $user["department"]["name"] }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
