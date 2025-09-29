<?php

namespace App\Http\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MenuComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $menus = Menu::orderBy('order')->get();

            $filteredMenus = $menus->filter(function ($menu) use ($user) {
                // Check if the user has the required permission for the menu item
                return $user->can($menu->permission_name);
            });

            $view->with('menus', $filteredMenus);
        }
    }
}
