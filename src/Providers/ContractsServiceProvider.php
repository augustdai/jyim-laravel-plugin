<?php

namespace Jyim\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Jyim\LaravelPlugin\Contracts\RepositoryInterface;
use Jyim\LaravelPlugin\Support\Repositories\FileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, FileRepository::class);
    }
}
