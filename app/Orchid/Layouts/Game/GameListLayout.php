<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Game;

use App\Models\Game;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GameListLayout extends Table
{
    protected $target = 'games';

    /**
     * @return TD[]
     */
    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Game $game) : Link
                {
                    return Link::make($game->name)->route('platform.games.edit', $game->id);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
