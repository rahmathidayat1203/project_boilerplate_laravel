<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallUiTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:ui-theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install UI theme and publish assets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $theme = $this->choice(
            'Which UI theme would you like to install?',
            ['AdminLTE', 'Argon']
        );

        if ($theme === 'AdminLTE') {
            $this->installAdminLte();
        }

        if ($theme === 'Argon') {
            $this->installArgon();
        }

        return 0;
    }

    private function installAdminLte()
    {
        $this->info('Installing AdminLTE theme...');

        $this->info('Updating package.json...');
        $this->updatePackageJson();

        $this->info('Updating vite.config.js...');
        $this->updateViteConfig();

        $this->info('Updating tailwind.config.js...');
        $this->updateTailwindConfig();

        $this->info('Creating asset files...');
        $this->createAssetFiles();

        $this->info('Creating layout file...');
        $this->createLayoutFile();

        $this->info('Updating view files...');
        $this->updateBladeFiles();

        $this->info('AdminLTE theme installed successfully.');
        $this->comment('Please run "npm install && npm run dev" to compile the assets.');
    }

    private function installArgon()
    {
        $this->info('Installing Argon Dashboard...');
        $this->warn('Argon integration is not yet implemented.');
    }

    private function updatePackageJson()
    {
        $packageJsonPath = base_path('package.json');
        $packageJson = json_decode(file_get_contents($packageJsonPath), true);

        $packageJson['devDependencies']['@tailwindcss/vite'] = '^4.1.13';
        $packageJson['devDependencies']['admin-lte'] = '3.2';
        $packageJson['devDependencies']['autoprefixer'] = '^10.4.19';
        $packageJson['devDependencies']['postcss'] = '^8.4.38';
        $packageJson['devDependencies']['tailwindcss'] = '^3.4.3';

        file_put_contents($packageJsonPath, json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    private function updateViteConfig()
    {
        $viteConfigPath = base_path('vite.config.js');
        $viteConfigContent = "import { defineConfig } from 'vite';\n";
        $viteConfigContent .= "import laravel from 'laravel-vite-plugin';\n";
        $viteConfigContent .= "import tailwindcss from '@tailwindcss/vite';\n\n";
        $viteConfigContent .= "export default defineConfig({\n";
        $viteConfigContent .= "    plugins: [\n";
        $viteConfigContent .= "        laravel({\n";
        $viteConfigContent .= "            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/adminlte.css', 'resources/js/adminlte.js'],\n";
        $viteConfigContent .= "            refresh: true,\n";
        $viteConfigContent .= "        }),\n";
        $viteConfigContent .= "        tailwindcss(),\n";
        $viteConfigContent .= "    ],\n";
        $viteConfigContent .= "});\n";

        file_put_contents($viteConfigPath, $viteConfigContent);
    }

    private function updateTailwindConfig()
    {
        $tailwindConfigPath = base_path('tailwind.config.js');
        $tailwindConfigContent = "/** @type {import('tailwindcss').Config} */\n";
        $tailwindConfigContent .= "export default {\n";
        $tailwindConfigContent .= "    content: [\n";
        $tailwindConfigContent .= "        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',\n";
        $tailwindConfigContent .= "        './storage/framework/views/*.php',\n";
        $tailwindConfigContent .= "        './resources/views/**/*.blade.php',\n";
        $tailwindConfigContent .= "    ],\n\n";
        $tailwindConfigContent .= "    theme: {\n";
        $tailwindConfigContent .= "        extend: {},
";
        $tailwindConfigContent .= "    },\n\n";
        $tailwindConfigContent .= "    plugins: [],\n";
        $tailwindConfigContent .= "};
";

        file_put_contents($tailwindConfigPath, $tailwindConfigContent);
    }

    private function createAssetFiles()
    {
        // AdminLTE CSS
        $adminLteCssPath = resource_path('css/adminlte.css');
        $adminLteCssContent = "/* Import AdminLTE css */\n@import 'admin-lte/dist/css/adminlte.min.css';\n";
        file_put_contents($adminLteCssPath, $adminLteCssContent);

        // AdminLTE JS
        $adminLteJsPath = resource_path('js/adminlte.js');
        $adminLteJsContent = "import 'admin-lte/dist/js/adminlte.min.js';\n";
        file_put_contents($adminLteJsPath, $adminLteJsContent);
    }

    private function createLayoutFile()
    {
        $layoutPath = resource_path('views/layouts/adminlte.blade.php');
        File::ensureDirectoryExists(dirname($layoutPath));
        file_put_contents($layoutPath, $this->getAdminLteLayoutContent());
    }

    private function getAdminLteLayoutContent()
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName ?? config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    @vite(['resources/css/adminlte.css', 'resources/js/adminlte.js'])
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">{{ $appName ?? config('app.name', 'Laravel') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @can('user-list')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Permissions</p>
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid pt-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">{{ $appName ?? config('app.name', 'Laravel') }}</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
HTML;
    }

    private function updateBladeFiles()
    {
        $this->info('Updating Blade files...');

        $views = [
            'dashboard.blade.php',
            'permissions/create.blade.php',
            'permissions/edit.blade.php',
            'permissions/index.blade.php',
            'profile/edit.blade.php',
            'profile/show.blade.php',
            'roles/create.blade.php',
            'roles/edit.blade.php',
            'roles/index.blade.php',
            'settings/index.blade.php',
            'users/edit.blade.php',
            'users/index.blade.php',
        ];

        foreach ($views as $view) {
            $path = resource_path('views/' . $view);
            if (File::exists($path)) {
                $content = File::get($path);
                $content = str_replace("@extends('layouts.app')", "@extends('layouts.adminlte')", $content);
                File::put($path, $content);
                $this->line("  Updated {$view}");
            }
        }
    }
}
