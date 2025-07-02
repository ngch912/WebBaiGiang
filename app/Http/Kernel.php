protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'IsAdmin' => \App\Http\Middleware\IsAdmin::class, // Dùng đúng casing bạn gọi trong route
];