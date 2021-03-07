<?php

declare(strict_types=1);

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class RoleFilter extends Filter
{
    public $parameters = [
        'role',
    ];

    public function name() : string
    {
        return __('Roles');
    }

    public function run(Builder $builder) : Builder
    {
        return $builder->whereHas('roles', function (Builder $query) : void
        {
            $query->where('slug', $this->request->get('role'));
        });
    }

    public function display() : array
    {
        return [
            Select::make('role')
                ->fromModel(Role::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('role'))
                ->title(__('Roles')),
        ];
    }

    public function value() : string
    {
        return $this->name() . ': ' . Role::where('slug', $this->request->get('role'))->first()->name;
    }
}
