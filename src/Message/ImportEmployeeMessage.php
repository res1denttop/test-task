<?php

declare(strict_types=1);

namespace App\Message;

use Symfony\Component\HttpFoundation\Request;

readonly class ImportEmployeeMessage
{
    public function __construct(
        public Request $request
    ) {
    }
}
