@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/site/home.css') }}">
@endpush

<main>

    <section class="banner">
        <div class="bg-banner">        
            <div class="default-layout content flex flex-col justify-center items-center">
                <div class="title text-center text-white">Gamelogg</div>
                <div class="subtitle text-center center text-white">Faça seu backlog de jogos onde e quando quiser</div>
            </div>
        </div>
    </section>
    <section class="profile">
        @guest
            <div class="default-layout profile-text-guest text-white text-center flex flex-col justify-center items-center">
                <div class="text">
                    Para visualizar seus jogos, faça login ou crie uma conta.
                </div>
                <div class="auth mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary ms-2">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary ms-2">Registrar</a>
                </div>
            </div>
        @endguest
        @auth
            <div class="default-layout profile-text-auth px-2 text-white">
                <div class="welcome-text text-center pt-4">
                    Olá, <span class="font-bold">{{ auth()->user()->name }}!</span>
                </div>
                <div class="games">
                    <div class="text flex justify-between">
                        <span>Ultimos logs</span>
                        @if(count($logs) > 0) <a href="#">Ver meus logs</a> @endif
                    </div>
                    @if(count($logs) > 0)
                        <div class="game">

                        </div>
                    @else
                        <div class="text mt-6 text-white">
                            Você ainda não tem nenhum log.
                        </div>
                    @endif
                </div>
            </div>
        @endauth

    </section>
    <section class="default-layout games">
        <div class="title text-white mt-4 p-4">
            Jogos Populares
        </div>
        <div class="game-list flex flex-wrap justify-center">
            @foreach($games as $game)
                <a href="{{ route('game', $game->slug) }}" class="game block mx-2 mb-3">
                    <div class="game-image">
                        @if (!isset($game->cover) || !$game->cover->image_id)
                            <img src="{{ asset('assets/images/no-cover.jpg') }}" alt="{{ $game->name }}" title="{{ $game->name }}"/>
                        @else
                            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $game->cover->image_id }}.jpg" alt="{{ $game->name }}" title="{{ $game->name }}"/>
                        @endif
                    </div>
                    <div class="game-name text-center text-white">
                        <span class="p-2">{{ $game->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="title text-white mt-4 p-4">
            Lançados recentemente
        </div>
        <div class="game-list flex flex-wrap justify-center">
            @foreach($recentGames as $recentGame)
                <a href="{{ route('game', $recentGame->slug) }}" class="game block mx-2 mb-3">
                    <div class="game-image">
                        @if (!isset($recentGame->cover) || !$recentGame->cover->image_id)
                            <img src="{{ asset('assets/images/no-cover.jpg') }}" alt="{{ $recentGame->name }}" title="{{ $recentGame->name }}"/>
                        @else
                            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $recentGame->cover->image_id }}.jpg" alt="{{ $recentGame->name }}" title="{{ $recentGame->name }}"/>
                        @endif

                    </div>
                    <div class="game-name text-center text-white">
                        <span class="p-2">{{ $recentGame->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</main>
