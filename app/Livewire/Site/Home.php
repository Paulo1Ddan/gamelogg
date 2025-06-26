<?php

namespace App\Livewire\Site;

use App\Models\Gamelog;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class Home extends Component
{

    public function render()
    {
        $games = Game::select(['name', 'slug'])
            ->with(['cover'])
            ->limit(10)
            ->orderBy('total_rating_count', 'desc')
            ->orderBy('aggregated_rating_count', 'desc')
            ->orderBy('total_rating', 'desc')
            ->orderBy('hypes', 'desc')
            ->get();

        $recentGames = Game::with(['cover'])
            ->limit(10)
            ->whereBetween('first_release_date', now()->subDays(30), now())
            ->orderBy('total_rating_count', 'desc')
            ->orderBy('aggregated_rating_count', 'desc')
            ->orderBy('total_rating', 'desc')
            ->orderBy('hypes', 'desc')
            ->get();

        $logs = [];
        if (auth()->check()) {
            $logs = Gamelog::where("user_id", auth()->user()->id)->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }


        return view('livewire.site.home', ["games" => $games, "recentGames" => $recentGames, "logs" => $logs])->title("Home");
    }
}
