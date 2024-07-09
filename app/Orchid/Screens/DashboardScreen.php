<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\Dashboard\ChartBarDashboard;
use App\Orchid\Layouts\Dashboard\ChartLineDashboard;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DashboardScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
//            'charts'  => [
//                [
//                    'name'   => 'Some Data',
//                    'values' => [25, 40, 30, 35, 8, 52, 17],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//                [
//                    'name'   => 'Another Set',
//                    'values' => [25, 50, -10, 15, 18, 32, 27],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//                [
//                    'name'   => 'Yet Another',
//                    'values' => [15, 20, -3, -15, 58, 12, -17],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//                [
//                    'name'   => 'And Last',
//                    'values' => [10, 33, -8, -3, 70, 20, -34],
//                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
//                ],
//            ],
//            'table'   => [
//                new Repository(['id' => 100, 'name' => self::TEXT_EXAMPLE, 'price' => 10.24, 'created_at' => '01.01.2020']),
//                new Repository(['id' => 200, 'name' => self::TEXT_EXAMPLE, 'price' => 65.9, 'created_at' => '01.01.2020']),
//                new Repository(['id' => 300, 'name' => self::TEXT_EXAMPLE, 'price' => 754.2, 'created_at' => '01.01.2020']),
//                new Repository(['id' => 400, 'name' => self::TEXT_EXAMPLE, 'price' => 0.1, 'created_at' => '01.01.2020']),
//                new Repository(['id' => 500, 'name' => self::TEXT_EXAMPLE, 'price' => 0.15, 'created_at' => '01.01.2020']),
//
//            ],
//            'metrics' => [
//                'sales'    => ['value' => number_format(6851), 'diff' => 10.08],
//                'visitors' => ['value' => number_format(24668), 'diff' => -30.76],
//                'orders'   => ['value' => number_format(10000), 'diff' => 0],
//                'total'    => number_format(65661),
//            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Dashboard';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return '';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Sales Today'    => 'metrics.sales',
                'Visitors Today' => 'metrics.visitors',
                'Pending Orders' => 'metrics.orders',
                'Total Earnings' => 'metrics.total',
            ]),

            Layout::columns([
                ChartLineDashboard::make('charts', 'Line Chart')
                    ->description('Visualize data trends with multi-colored line graphs.'),

                ChartBarDashboard::make('charts', 'Bar Chart')
                    ->description('Compare data sets with colorful bar graphs.'),
            ]),
        ];
    }
}
