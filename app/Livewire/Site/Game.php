<?php

namespace App\Livewire\Site;

use App\Models\UserFavorite;
use Illuminate\Support\Collection;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;
use Throwable;

class Game extends Component
{
    public $slug;
    public $teste = "";
    public int $gameId;
    public string $msg = "";
    public bool $hasFavorite = false;

    public function mount($slug)
    {
        $game = IGDBGame::select(['id'])->where('slug', $this->slug)->first();
        $this->gameId = $game->id;
        $this->slug = $slug;
    }

    public function render()
    {
        $game = IGDBGame::with(['cover', 'screenshots', "involved_companies.company", "platforms", "genres"])->where('slug', $this->slug)->first();
        $companies = $game->involved_companies;
        $platforms = $game->platforms;
        $genres = $game->genres;

        $this->hasFavorite = UserFavorite::where("game_id", $this->gameId)->where("user_id", auth()->user()->id)->exists();

        return view('livewire.site.game', ["game" => $game, "companies" => $companies, "platforms" => $platforms, "genres" => $genres, "teste" => $this->teste])->title($game->name);
    }

    public function favorite()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($this->hasFavorite) {
            try {
                UserFavorite::where("game_id", $this->gameId)->where("user_id", auth()->user()->id)->delete();
                $this->msg = "Removido dos favoritos.";
            } catch (Throwable $th) {
                $this->msg = "Erro ao revomer nos favoritos $th";
            }
        } else {
            try {
                UserFavorite::Create([
                    "user_id" => $user->id,
                    "game_id" => $this->gameId
                ]);
                $this->msg = "Jogo salvo nos favorítos.";
            } catch (Throwable $th) {
                $this->msg = "Erro ao salvar nos favoritos $th";
            }
        }
    }
}
