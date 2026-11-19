<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
public function register(): void
{
//
}
public function boot(): void
{
// Os links de paginação usam as classes do Bootstrap 5
Paginator::useBootstrapFive();
// Regra "admin": passa se o usuário tiver nivel_acesso = 2
Gate::define('admin', fn (User $user) => $user->isAdmin());
}
}
