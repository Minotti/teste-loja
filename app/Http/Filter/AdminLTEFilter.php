<?php

namespace App\Http\Filter;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class AdminLTEFilter implements FilterInterface
{
    protected $laratrust;

    public function __construct(Laratrust $laratrust)
    {
        $this->laratrust = $laratrust;
    }

    public function transform($item)
    {
        if (! $this->isVisible($item)) {
            return false;
        }

        return $item;
    }

    protected function isVisible($item)
    {
        if (isset($item['role'])) {
           return $this->laratrust->hasRole($item['role']);
        }

        if (! isset($item['can'])) {
            return true;
        }

        return $this->laratrust->isAbleTo($item['can']);
    }
}
