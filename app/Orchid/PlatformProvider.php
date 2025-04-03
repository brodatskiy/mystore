<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Store page'))
                ->icon('bs.cart')
                ->class('nav-link d-flex align-items-center collapsed icon-link link-info')
                ->route('/')
                ->permission('platform.users'),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.users')
                ->permission('platform.users'),

            Menu::make(__('Products'))
                ->icon('bs.folder')
                ->route('platform.products'),

            Menu::make(__('Categories'))
                ->icon('bs.bookmarks')
                ->route('platform.categories'),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.roles')
                ->permission('platform.roles'),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.roles', __('Roles'))
                ->addPermission('platform.users', __('Users'))
                ->addPermission('platform.products', __('Products'))
                ->addPermission('platform.categories', __('Categories')),
        ];
    }
}
