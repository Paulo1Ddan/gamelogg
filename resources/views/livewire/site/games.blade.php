@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/site/games.css') }}">
@endpush

<main>
    <section class="default-layout games text-white">
        <div class="title mt-4 ps-4 flex justify-between">{{ $title }}</div>
        <div class="filters ps-4 flex my-4 space-x-4">
            <button wire:click="changeFilter('popular')"
                class="{{ $currentFilter === 'popular' ? 'font-bold text-[#863fcd]' : '' }}">Populares</button>
            <button wire:click="changeFilter('newest')"
                class="{{ $currentFilter === 'newest' ? 'font-bold text-[#863fcd]' : '' }}">Recentes</button>
            <button wire:click="changeFilter('top-rated')"
                class="{{ $currentFilter === 'top-rated' ? 'font-bold text-[#863fcd]' : '' }}">Melhores
                Avaliados</button>
            <button wire:click="changeFilter('alphabetical')"
                class="{{ $currentFilter === 'alphabetical' ? 'font-bold text-[#863fcd]' : '' }}">A-Z</button>
        </div>
        <!-- Spinner ou carregando -->
        <div wire:loading class="text-center text-white my-4 ps-4">
            Carregando jogos...
        </div>

        {{-- Jogos --}}
        <div wire:loading.remove class="game-list flex flex-wrap justify-center">
            @foreach ($games as $game)
                <a href="{{ route('game', $game->slug) }}" class="game block mx-2 mb-3">
                    <div class="game-image">
                        @if (!isset($game->cover) || !$game->cover->image_id)
                            <img src="{{ asset('assets/images/no-cover.jpg') }}" alt="{{ $game->name }}"
                                title="{{ $game->name }}" />
                        @else
                            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $game->cover->image_id }}.jpg"
                                alt="{{ $game->name }}" title="{{ $game->name }}" />
                        @endif
                    </div>
                    <div class="game-name text-center text-white">
                        <span class="p-2">{{ $game->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Paginaçãoo --}}
    <div class="mt-6 mb-6 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0">
        {{-- Controles de paginação --}}
        <div class="inline-flex rounded-md shadow-sm isolate" role="group">
            {{-- Anterior --}}
            <button wire:click="previousPage"
                class="px-3 py-2 text-sm font-medium {{ $page == 1 ? 'text-gray-400 bg-gray-100 cursor-not-allowed dark:bg-gray-800' : 'text-gray-700 bg-white hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200' }} border border-gray-300 dark:border-gray-600 rounded-l-md"
                {{ $page == 1 ? 'disabled' : '' }}>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L9.414 10l3.293 3.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            {{-- Números das páginas --}}
            @php
                $start = max(1, $page - 1);
                $end = min($totalPages, $page + 1);
            @endphp

            {{-- Primeira página sempre visível --}}
            <button wire:click="goToPage(1)"
                class="px-3 py-2 text-sm font-medium {{ $page == 1 ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200' }} border-t border-b border-gray-300 dark:border-gray-600">
                1
            </button>

            {{-- Reticências se necessário --}}
            @if ($start > 2)
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 border-t border-b border-gray-300 dark:border-gray-600 select-none">...</span>
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i != 1 && $i != $totalPages)
                    <button wire:click="goToPage({{ $i }})"
                        class="px-3 py-2 text-sm font-medium {{ $page == $i ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200' }} border-t border-b border-gray-300 dark:border-gray-600">
                        {{ $i }}
                    </button>
                @endif
            @endfor

            {{-- Reticências finais se necessário --}}
            @if ($end < $totalPages - 1)
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 border-t border-b border-gray-300 dark:border-gray-600 select-none">...</span>
            @endif

            {{-- Última página sempre visível se for maior que 1 --}}
            @if ($totalPages > 1)
                <button wire:click="goToPage({{ $totalPages }})"
                    class="px-3 py-2 text-sm font-medium {{ $page == $totalPages ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200' }} border-t border-b border-gray-300 dark:border-gray-600">
                    {{ $totalPages }}
                </button>
            @endif

            {{-- Próxima --}}
            <button wire:click="nextPage"
                class="px-3 py-2 text-sm font-medium {{ $page * $perPage >= $totalGames ? 'text-gray-400 bg-gray-100 cursor-not-allowed dark:bg-gray-800' : 'text-gray-700 bg-white hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200' }} border border-gray-300 dark:border-gray-600 rounded-r-md"
                {{ $page * $perPage >= $totalGames ? 'disabled' : '' }}>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 001.414 0L13 10l-4.293-4.293a1 1 0 00-1.414 1.414L10.586 10l-3.293 3.293a1 1 0 000 1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('urlUpdated', () => {
                // Força a atualização da URL sem recarregar a página
                history.pushState(null, null, window.location.pathname + '?' + new URLSearchParams({
                    page: @this.page,
                    currentFilter: @this.currentFilter
                }).toString());
            });
        });
    </script>

</main>
