<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RolFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = [])
    {
        // Get the required role from the arguments
        $requiredRoles = $arguments;
        $user = session()->get('usuario');

        foreach ($requiredRoles as $role) {
            if ($user["id_rol"] === $role) {
                // If the user has one of the required roles, allow the request to pass through
                return;
            }
        }

        // If the user doesn't have any of the required roles, redirect to an unauthorized page or throw an exception
        return redirect()->to('/');
        // or throw new \Exception('Unauthorized access');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No implementation needed for this example
    }
}
