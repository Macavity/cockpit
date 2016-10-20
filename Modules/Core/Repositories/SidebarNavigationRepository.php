<?php namespace Modules\Core\Repositories;

use Sentinel;

class SidebarNavigationRepository
{
    public function getSidebarMenus() {

        if(Sentinel::guest() || Sentinel::inRole('admin') === false){
            return [];
        }

        $menu = [
            'Main' => [
                'label' => 'Main',
                'children' => [
                    [
                        'label' => 'Dashboard',
                        'route' => 'dashboard',
                        'icon' => 'home',
                    ],
                    /*[
                        'label' => 'Companies',
                        'route' => 'companies',
                        'icon' => 'briefcase',
                    ],
                    [
                        'label' => 'Users',
                        'route' => 'users',
                        'icon' => 'users',
                    ],*/
                ]
            ],
        ];

        return $menu;

    }
}
