<?php declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserDetailLayout extends Rows
{
    public const READ_ONLY = true;

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            DateTimer::make('user.created_at')
                ->title('Created')
                ->disabled(self::READ_ONLY),
            DateTimer::make('user.updated_at')
                ->title('Updated')
                ->disabled(self::READ_ONLY),
            Input::make('user.login')
                ->title('Login')
                ->readonly(self::READ_ONLY),
            Input::make('user.heroes_count')
                ->title('Heroes count')
                ->readonly(self::READ_ONLY)
        ];
    }
}
