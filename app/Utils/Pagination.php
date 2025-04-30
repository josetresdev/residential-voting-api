<?php

namespace App\Utils;

class Pagination
{
    public static function paginate($query, $perPage = null)
    {
        $perPage = $perPage ?? request()->input('per_page', 15);
        return $query->paginate($perPage)->appends(request()->query());
    }
}
