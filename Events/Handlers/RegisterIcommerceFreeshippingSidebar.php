<?php

namespace Modules\IcommerceFreeshipping\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIcommerceFreeshippingSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        /*
        $menu->group(trans('core::sidebar.content'), function (Group $group) {

            $group->item(trans('icommercefreeshipping::icommercefreeshippings.title.icommercefreeshippings'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                    
                );

                $item->item(trans('icommercefreeshipping::configurations.title.configurations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.icommercefreeshipping.configuration.create');
                    $item->route('admin.icommercefreeshipping.configuration.index');
                    $item->authorize(
                        $this->auth->hasAccess('icommercefreeshipping.configurations.index')
                    );
                });
// append

            });
        });
        */


        return $menu;
    }
}
