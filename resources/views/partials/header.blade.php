<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center bg-light">
    <a href="/" class="navbar-brand d-flex w-50 mr-auto">曌咖工作坊</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
        <ul class="navbar-nav w-100 justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="#" style="color: rgba(192,38,19,0.96)">{{ $top_content }}</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">

            <li class="nav-item active" @if (Auth::check()) hidden @endif>
                <a class="nav-link" href="#">聯絡電話：0968779056 何先生</a>
            </li>

            @if (Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manage.index') }}" style="color: rgba(7,21,192,0.96)"><i class="fas fa-user-shield"></i> 後台管理系統</a>
            </li>
            @endif
        </ul>
    </div>
</nav>