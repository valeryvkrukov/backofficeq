<?php

namespace App\Services;


use App\Models\User;
use App\Services\Contracts\CheckAccessToResourceInterface;

class CheckAccessToResource implements CheckAccessToResourceInterface
{
    public function check(array $codesList)
    {
        if (empty($codesList)) {
            return false;
        }
        try {
            $user = User::with('roles.resource')->where('id', auth()->user()->id)->first();
            $codes = $user->roles->pluck('resources')->flatten()->filter(function ($resource) use ($codesList) {
                return in_array($resource->code, $codesList);
            })->pluck('code');
            return count($codes) > 0;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
