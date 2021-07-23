<?php


namespace App\Filters;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserFilter
{
    private $query;

    public function __construct(Builder $query = null)
    {
        $this->query = $query ?? User::query();
    }

    public function apply(array $filters): self
    {
        foreach ($filters as $key => $value) {
            if ($this->filterAvailable($key)) {
                $this->{$key}($value);
            }
        }
        return $this;
    }

    private function filterAvailable($filter): bool
    {
        return in_array($filter, get_class_methods(get_called_class()));
    }

    public function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * nationality column filter
     *
     * @param string $value
     * @return UserFilter $this
     */
    public function nat(string $value): self
    {
        $this->query->where('nat', '=', $value);
        return $this;
    }

}
