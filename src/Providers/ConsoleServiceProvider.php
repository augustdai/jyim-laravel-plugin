<?php

namespace Jyim\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Str;
use Jyim\LaravelPlugin\Console\Commands\ComposerInstallCommand;
use Jyim\LaravelPlugin\Console\Commands\ComposerRemoveCommand;
use Jyim\LaravelPlugin\Console\Commands\ComposerRequireCommand;
use Jyim\LaravelPlugin\Console\Commands\ControllerMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\DisableCommand;
use Jyim\LaravelPlugin\Console\Commands\DownLoadCommand;
use Jyim\LaravelPlugin\Console\Commands\EnableCommand;
use Jyim\LaravelPlugin\Console\Commands\InstallCommand;
use Jyim\LaravelPlugin\Console\Commands\ListCommand;
use Jyim\LaravelPlugin\Console\Commands\LoginCommand;
use Jyim\LaravelPlugin\Console\Commands\MigrateCommand;
use Jyim\LaravelPlugin\Console\Commands\MigrationMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\ModelMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\PluginCommand;
use Jyim\LaravelPlugin\Console\Commands\PluginDeleteCommand;
use Jyim\LaravelPlugin\Console\Commands\PluginMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\ProviderMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\PublishCommand;
use Jyim\LaravelPlugin\Console\Commands\RegisterCommand;
use Jyim\LaravelPlugin\Console\Commands\RouteProviderMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\SeedMakeCommand;
use Jyim\LaravelPlugin\Console\Commands\UploadCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Namespace of the console commands.
     *
     * @var string
     */
    protected string $consoleNamespace = 'Jyim\\LaravelPlugin\\Console\\Commands';

    /**
     * The available commands.
     *
     * @var array
     */
    protected array $commands = [
        PluginCommand::class,
        PluginMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ControllerMakeCommand::class,
        ModelMakeCommand::class,
        MigrationMakeCommand::class,
        MigrateCommand::class,
        SeedMakeCommand::class,
        ComposerRequireCommand::class,
        ComposerRemoveCommand::class,
        ComposerInstallCommand::class,
        ListCommand::class,
        DisableCommand::class,
        EnableCommand::class,
        PluginDeleteCommand::class,
        InstallCommand::class,
        PublishCommand::class,
        RegisterCommand::class,
        LoginCommand::class,
        UploadCommand::class,
        DownLoadCommand::class,

    ];

    /**
     * @return array
     */
    private function resolveCommands(): array
    {
        $commands = [];

        foreach ((config('plugins.commands') ?: $this->commands) as $command) {
            $commands[] = Str::contains($command, $this->consoleNamespace) ?
                $command :
                $this->consoleNamespace.'\\'.$command;
        }

        return $commands;
    }

    public function register(): void
    {
        $this->commands($this->resolveCommands());
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
