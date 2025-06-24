@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/site/game.css') }}">
    <style>
        .game .banner {
            background-image: url(https://images.igdb.com/igdb/image/upload/t_1080p/{{ $game->screenshots[0]->image_id }}.webp);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 300px;
        }
    </style>
@endpush

<main>
    <section class="game">
        <div class="banner">
            <div class="bg-overlay flex justify-center items-center">
                <h1 class="game-title text-white">
                    {{ $game->name }}
                </h1>
            </div>
        </div>
        <div class="content default-layout flex items-center mt-2 p-2">
            <div class="game-cover me-2">
                @if (!isset($game->cover) || !$game->cover->image_id)
                    <img src="{{ asset('assets/images/no-cover.jpg') }}" alt="{{ $game->name }}"
                        title="{{ $game->name }}" />
                @else
                    <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $game->cover->image_id }}.jpg"
                        alt="{{ $game->name }}" title="{{ $game->name }}" />
                @endif
            </div>
            <div class="game-info ms-2 px-2 self-start text-white">
                <div class="game-title">
                    {{ $game->name }}
                </div>
                <div class="release-date my-2">
                    <strong>Lançado em: </strong>{{ date_format($game->first_release_date, 'd/m/Y') }}
                </div>
                <div class="companies my-2">
                    <strong>Desenvolvido/Publicado por: </strong>
                    @foreach ($companies as $company)
                        {{ $company->company->name }}@if(!$loop->last),@endif
                    @endforeach
                </div>
                <div class="platforms my-2">
                    <strong>Plataformas:</strong>
                    @foreach ($platforms as $platform)
                        {{ $platform->name }}@if(!$loop->last),@endif
                    @endforeach
                </div>
                <div class="genres my-2">
                    <strong>Generos:</strong>
                    @foreach ($genres as $genre)
                        {{ $genre->name }}@if(!$loop->last),@endif
                    @endforeach
                </div>
                <div class="log flex">
                    <button class="btn btn-primary"><i class="bi bi-stack"></i> Criar log</button>
                    @if($hasFavorite)
                        <button class="btn btn-secondary mx-2 text-yellow-200" wire:click="favorite"><i class="bi bi-star-fill"></i> Favorito</button>
                    @else
                        <button class="btn btn-secondary mx-2" wire:click="favorite"><i class="bi bi-star-fill"></i> Favorito</button>
                    @endif
                </div>
                <div class="teste">
                    {{ $msg }}
                </div>
            </div>
        </div>
    </section>
</main>
