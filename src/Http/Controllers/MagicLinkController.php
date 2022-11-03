<?php

namespace Gridonic\StatamicBoilerplateAddon\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Statamic\Facades\User;

class MagicLinkController extends Controller
{
    public function login(string $token)
    {
        if ($this->isAuthenticated()) {
            return redirect($this->cpUrl());
        }

        $secret = config('statamic.boilerplate.magic_links_secret');
        try {
            $decoded = JWT::decode(base64_decode($token), new Key($secret, 'HS256'));
            $user = User::findByEmail($decoded->sub);
            if ($user) {
                Auth::login($user);
                return redirect($this->cpUrl());
            }
            return response('Statamic user not found', 401);
        } catch (\Exception $e) {
            return response('Invalid magic link used', 403);
        }
    }

    private function isAuthenticated(): bool
    {
        return Auth::check();
    }

    private function cpUrl(): string
    {
        return sprintf('/%s', config('statamic.cp.route'));
    }
}
