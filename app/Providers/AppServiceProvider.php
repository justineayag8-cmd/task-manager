<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (getenv('CODESPACES') === 'true') {
            $codespaceName = getenv('CODESPACE_NAME');
            $domain = getenv('GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN') ?: 'app.github.dev';

            $url = "https://{$codespaceName}-8000.{$domain}";

            URL::forceRootUrl($url);
            URL::forceScheme('https');
        }
    }
}