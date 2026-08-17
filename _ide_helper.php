<?php

/**
 * IDE Helper for Laravel & Intelephense
 */

namespace Illuminate\Support\Facades {
    /**
     * @method static \App\Models\User|null user()
     * @method static int|string|null id()
     * @method static bool check()
     * @method static bool guest()
     * @method static bool attempt(array $credentials = [], bool $remember = false)
     * @method static void login(\Illuminate\Contracts\Auth\Authenticatable $user, bool $remember = false)
     * @method static void logout()
     * @method static \Illuminate\Contracts\Auth\Guard guard(string|null $name = null)
     */
    class Auth extends \Illuminate\Support\Facades\Facade {}

    /**
     * @method static \Illuminate\Database\Query\Builder table(string $table, string|null $as = null)
     * @method static \Illuminate\Database\Query\Expression raw(mixed $value)
     * @method static \Illuminate\Database\Query\Builder select(string $query, array $bindings = [], bool $useReadPdo = true)
     * @method static mixed transaction(\Closure $callback, int $attempts = 1)
     */
    class DB extends \Illuminate\Support\Facades\Facade {}
}

namespace {
    class Auth extends \Illuminate\Support\Facades\Auth {}
    class DB extends \Illuminate\Support\Facades\DB {}
    class Route extends \Illuminate\Support\Facades\Route {}
    class Mail extends \Illuminate\Support\Facades\Mail {}
    class Hash extends \Illuminate\Support\Facades\Hash {}
    class Session extends \Illuminate\Support\Facades\Session {}
    class File extends \Illuminate\Support\Facades\File {}

    /**
     * @param string|null $guard
     * @return \Illuminate\Contracts\Auth\StatefulGuard|\Illuminate\Contracts\Auth\Guard|\App\Models\User|mixed
     */
    function auth($guard = null) {}
}
