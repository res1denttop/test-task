<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class ImportRequest
{
    public function __construct(private Request $request)
    {
    }

    public function getStream()
    {
        return $this->request->getContent(true);
    }
}
