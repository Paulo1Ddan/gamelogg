<?php

namespace App\Livewire\Site;

use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class Teste extends Component
{
    private $games;

    public function render()
    {
        $this->games = Game::where('name', 'Fortnite')->get();
        return view('livewire.site.teste')->with(["games" => $this->games]);
    }
}
