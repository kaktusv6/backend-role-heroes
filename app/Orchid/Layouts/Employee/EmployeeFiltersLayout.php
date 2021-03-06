<?php

namespace App\Orchid\Layouts\Employee;

use App\Orchid\Filters\RoleFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class EmployeeFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters() : array
    {
        return [
            RoleFilter::class,
        ];
    }
}
