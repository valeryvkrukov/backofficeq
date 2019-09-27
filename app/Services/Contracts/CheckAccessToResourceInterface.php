<?php

namespace App\Services\Contracts;

interface CheckAccessToResourceInterface
{
    public function check(array $codesList);
}
