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

        $this->info('Updating package.json for Argon...');
        $this->updatePackageJsonForArgon();

        $this->info('Updating vite.config.js for Argon...');
        $this->updateViteConfigForArgon();

        $this->info('Creating asset files for Argon...');
        $this->createAssetFilesForArgon();

        $this->info('Creating layout file for Argon...');
        $this->createLayoutFileForArgon();

        $this->info('Updating view files to use Argon layout...');
        $this->updateBladeFiles('argon');

        $this->info('Argon Dashboard installed successfully.');
        $this->comment('Please run "npm install && npm run dev" to compile the assets.');
    }

    private function updatePackageJsonForArgon()
    {
        $packageJsonPath = base_path('package.json');
        $packageJson = json_decode(file_get_contents($packageJsonPath), true);

        $packageJson['devDependencies']['@creative-tim-official/argon-dashboard-free'] = 'latest';

        file_put_contents($packageJsonPath, json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    private function updateViteConfigForArgon()
    {
        $viteConfigPath = base_path('vite.config.js');
        $viteConfigContent = "import { defineConfig } from 'vite';\n";
        $viteConfigContent .= "import laravel from 'laravel-vite-plugin';\n";
        $viteConfigContent .= "import tailwindcss from '@tailwindcss/vite';\n\n";
        $viteConfigContent .= "export default defineConfig({\n";
        $viteConfigContent .= "    plugins: [\n";
        $viteConfigContent .= "        laravel({\n";
        $viteConfigContent .= "            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/argon.css', 'resources/js/argon.js', 'resources/css/datatables.css', 'resources/js/datatables.js'],\n";
        $viteConfigContent .= "            refresh: true,\n";
        $viteConfigContent .= "        }),\n";
        $viteConfigContent .= "        tailwindcss(),\n";
        $viteConfigContent .= "    ],\n";
        $viteConfigContent .= "});\n";

        file_put_contents($viteConfigPath, $viteConfigContent);
    }

    private function createAssetFilesForArgon()
    {
        // Argon CSS
        $argonCssPath = resource_path('css/argon.css');
        $argonCssContent = "/* Import Argon Dashboard css */\n@import '@creative-tim-official/argon-dashboard-free/assets/css/argon-dashboard.css';\n";
        file_put_contents($argonCssPath, $argonCssContent);

        // Argon JS
        $argonJsPath = resource_path('js/argon.js');
        $argonJsContent = "import '@creative-tim-official/argon-dashboard-free/assets/js/argon-dashboard.js';\n";
        file_put_contents($argonJsPath, $argonJsContent);
    }

    private function createLayoutFileForArgon()
    {
        $layoutPath = resource_path('views/layouts/argon.blade.php');
        File::ensureDirectoryExists(dirname($layoutPath));
        file_put_contents($layoutPath, $this->getArgonLayoutContent());
    }

    private function getArgonLayoutContent()
    {
        return <<<'HTML'
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/argon.css', 'resources/js/argon.js', 'resources/css/datatables.css'])
</head>
<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
        <span class="ms-1 font-weight-bold">{{ $appName ?? config('app.name', 'Laravel') }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    @include('layouts.partials.sidebar-argon')
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <a href="{{ route('profile.show') }}" class="nav-link text-white font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

      @yield('content')
      
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart"></i> by
                <a href="#" class="font-weight-bold">{{ $appName ?? config('app.name', 'Laravel') }}</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  @vite(['resources/js/datatables.js'])
  @stack('scripts')
</body>
</html>
HTML;
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
        $viteConfigContent .= "            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/adminlte.css', 'resources/js/adminlte.js', 'resources/css/datatables.css', 'resources/js/datatables.js'],\n";
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
        $tailwindConfigContent .= "};\n";

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
    
    @vite(['resources/css/adminlte.css', 'resources/css/datatables.css'])
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
            @include('layouts.partials.sidebar-adminlte')
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
@vite(['resources/js/adminlte.js', 'resources/js/datatables.js'])
@stack('scripts')
</body>
</html>
HTML;
    }

    private function updateBladeFiles($theme = 'adminlte')
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
            'menus/index.blade.php',
            'menus/create.blade.php',
            'menus/edit.blade.php',
        ];

        foreach ($views as $view) {
            $path = resource_path('views/' . $view);
            if (File::exists($path)) {
                $content = File::get($path);
                $content = preg_replace("/@extends\('layouts\.(app|adminlte|argon)'\)/", "@extends('layouts.{$theme}')", $content);
                File::put($path, $content);
                $this->line("  Updated {$view}");
            }
        }
    }
}