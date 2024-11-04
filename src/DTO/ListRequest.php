<?php

declare(strict_types=1);

namespace App\DTO;

readonly class ListRequest
{
    public function __construct(
        public int $page,
        public int $perPage,
    ) {
    }
}