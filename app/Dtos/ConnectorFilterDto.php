<?php

declare(strict_types=1);

namespace App\Dtos;

use Illuminate\Support\Collection;

final class ConnectorFilterDto
{
    private Collection $types;

    public function __construct(Collection $types)
    {
        $this->types = $types;
    }

    public function getTypes(): Collection
    {
        return $this->types;
    }
}
