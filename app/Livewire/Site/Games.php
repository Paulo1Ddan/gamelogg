<?php

namespace App\Livewire\Site;

use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class Games extends Component
{

    protected $queryString = [
        'page' => ['except' => 1],
        'currentFilter' => ['except' => '']
    ];

    public $page = 1;
    public $perPage = 60;
    public $totalGames;
    public $currentFilter = 'popular';

    public function mount()
    {
        if (request()->has('page')) {
            $this->page = (int) request()->query('page');
        }

        if (request()->has('currentFilter')) {
            $this->currentFilter = request()->query('currentFilter');
        }
    }

    public function changeFilter($filter)
    {
        $this->currentFilter = $filter;
        $this->page = 1;
        $this->dispatch('urlUpdated');
    }

    public function render()
    {
        $offset = ($this->page - 1) * $this->perPage;
        $this->totalGames = Game::where('themes', "!=", 42)->count();
        $title = $this->getTitle();

        $games = Game::select(['name', 'slug'])
            ->with(['cover'])
            ->where('themes', "!=", 42);

        switch ($this->currentFilter) {
            case 'popular':
                $games = $games->orderBy('total_rating_count', 'desc')
                    ->orderBy('aggregated_rating_count', 'desc')
                    ->orderBy('total_rating', 'desc')
                    ->orderBy('hypes', 'desc');
                break;

            case 'alphabetical':
                $games = $games->orderBy('name', 'asc');
                break;

            case 'newest':
                $games = $games->where('first_release_date', '<=', now())
                    ->whereNotNull('first_release_date')
                    ->orderBy('first_release_date', 'desc');
                break;

            case 'top-rated':
                $games = Game::select(['name', 'slug'])
                    ->with(['cover'])
                    ->where('themes', "!=", 42)
                    ->where('name', '!=', 'Hentai')
                    ->orderBy('total_rating', 'desc');
                break;

            default:
                $games = $games->orderBy('total_rating_count', 'desc')
                    ->orderBy('aggregated_rating_count', 'desc')
                    ->orderBy('total_rating', 'desc')
                    ->orderBy('hypes', 'desc');
                break;
        }

        $games = $games->limit($this->perPage)
            ->offset($offset)
            ->get();

        return view('livewire.site.games', [
            'title' => $title,
            'games' => $games,
            'totalPages' => ceil($this->totalGames / $this->perPage),
        ])->title("Games");
    }

    public function nextPage()
    {
        if ($this->page * $this->perPage < $this->totalGames) {
            $this->page++;
            $this->dispatch('urlUpdated');
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->dispatch('urlUpdated');
        }
    }

    public function goToPage($page)
    {
        if ($page >= 1 && $page <= ceil($this->totalGames / $this->perPage)) {
            $this->page = $page;
            $this->dispatch('urlUpdated');
        }
    }

    public function getTitle()
    {
        return match ($this->currentFilter) {
            'popular' => 'Jogos Populares',
            'alphabetical' => 'Jogos por Ordem Alfabética',
            'newest' => 'Jogos Recentes',
            'top-rated' => 'Jogos Mais Bem Avaliados',
            default => 'Games',
        };
    }
}
