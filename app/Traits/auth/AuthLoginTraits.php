<?php

namespace App\Traits\auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

trait AuthLoginTraits
{
    protected function validateAndRoute(string $table, string $route = null): RedirectResponse
    {
        request()->validate([
            'email' => 'required|exists:' . $table,
            'password' => 'required|min:8'
        ], [
            'email.exists' => 'The selected email not found.'
        ]);

        return redirect()->route($route);
    }

    /**
     * @throws AuthenticationException
     */

    protected function checkAuth($request): RedirectResponse
    {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password],
            $request->get('remember'))) {
            return $this->validateAndRoute('users', 'home');

        } else {
            Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],
                $request->get('remember'));
            return $this->validateAndRoute('admins', 'admin.dashboard');
        }
    }
}
