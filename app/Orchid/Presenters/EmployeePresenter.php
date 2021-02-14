<?php declare(strict_types=1);

namespace App\Orchid\Presenters;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class EmployeePresenter extends Presenter implements Searchable, Personable
{
    public function label() : string
    {
        return 'Employees';
    }

    public function title() : string
    {
        return $this->entity->name;
    }

    public function subTitle() : string
    {
        $roles = $this->entity->roles->pluck('name')->implode(' / ');

        return empty($roles)
            ? __('Regular user')
            : $roles;
    }

    public function url() : string
    {
        return route('platform.systems.employees.edit', $this->entity);
    }

    public function image() : ?string
    {
        $hash = md5(strtolower(trim($this->entity->email)));

        return "https://www.gravatar.com/avatar/$hash?d=mp";
    }

    public function perSearchShow() : int
    {
        return 3;
    }

    public function searchQuery(string $query = null) : Builder
    {
        return $this->entity->search($query);
    }
}
