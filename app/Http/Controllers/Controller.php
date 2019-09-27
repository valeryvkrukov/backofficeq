<?php

namespace App\Http\Controllers;

use App\Services\CheckAccessToResource;
use App\Services\BackofficeqLoggerService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $logger;
    protected $accessToResource;
    protected $resourceAccessCodes = [];

    public function __construct(
        CheckAccessToResource $accessToResource,
        BackofficeqLoggerService $logger
    )
    {
        $this->accessToResource = $accessToResource;
        $this->logger = $logger;
    }

    protected function checkResourceAccess(array $codes = null)
    {
        if (!auth()->user()->hasAnyRole(['system-administrator', 'software-administrator'])) {
            if (!$this->accessToResource->check($codes === null ? $this->resourceAccessCodes : $codes)
            ) {
                throw new AccessDeniedHttpException('Access denied', null, 403);
            }
        }
    }

    public function submit(Request $req)
    {
        return response()->json([
            'username' =>  $req->post('username'),
            'password_hash' => password_hash($req->post('password'), PASSWORD_BCRYPT),
        ]);
    }
}

