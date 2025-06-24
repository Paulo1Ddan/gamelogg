<header class="header p-4 flex justify-between items-center text-white">
    <a href="{{ route('home') }}" class="logo block">
        Gamelogg
    </a>
    <form action="" method="get" class="search flex">
        <input type="text" name="search" placeholder="Procurar jogo..." class="search-input">
        <button type="submit" title="Pesquisar" class="search-button ms-2"><i class="bi bi-search"></i></button>
    </form>
    <div class="auth">
        @guest
            <a href="{{ route('games') }}">Jogos</a>
            <span class="mx-2">|</span>
            <a href="{{ route('login') }}">Entrar</a> <span class="mx-2">|</span>
            <a href="{{ route('register') }}">Registrar</a>
        @endguest
        @auth
            <a href="{{ route('games') }}">Jogos</a>
            <span class="mx-2">|</span>
            <a href="{{ route('games') }}">{{auth()->user()->name}}</a>
        @endauth
    </div>
</header>