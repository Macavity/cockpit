<?php namespace Modules\Core\Composers;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Modules\Core\Repositories\SidebarNavigationRepository;
use Sentinel;

class NavigationComposer
{
    private $navigation;

    public function __construct(SidebarNavigationRepository $sidebarNavigationRepository) {
        $this->navigation = $sidebarNavigationRepository;
    }

    public function compose(View $view){
        $isLoggedIn = Sentinel::check();

        $messages = [];
        $notifications = [];
        $user = false;
        $isAdmin = false;

        if($isLoggedIn) {
            $user = User::find(Sentinel::getUser()->getUserId());
            $isAdmin = Sentinel::inRole('admin');
        }

        $view->with(compact(['isLoggedIn', 'messages', 'notifications', 'user', 'isAdmin']));

        $this->composeMenu($view);

    }

    public function composeMenu(View $view)
    {
        $sidenav = $this->navigation->getSidebarMenus();

        // Check if any route is currently active.
        foreach($sidenav as $categoryKey => $categoryRow) {

            foreach ($categoryRow['children'] as $childKey => $childRow) {
                $sidenav[$categoryKey]['children'][$childKey]['active'] = (\Request::route()->getName() === $childRow['route']) ? true : false;
                if(empty($sidenav[$categoryKey]['children'][$childKey]['url'])){
                    $sidenav[$categoryKey]['children'][$childKey]['url'] = route($childRow['route']);
                }
            }

        }

        $view->with('sidenav', $sidenav);
    }
}
