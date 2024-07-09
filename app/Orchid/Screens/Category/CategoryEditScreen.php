<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Models\Product;
use App\Orchid\Layouts\Category\CategoryEditLayout;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CategoryEditScreen extends Screen
{
    /**
     * @var Category
     */
    public $category;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {

        return [
            'category' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Create category';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Category page.';
    }

    public function permission(): ?iterable
    {
        return [
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the category is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->category->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            CategoryEditLayout::class,
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(Request $request, Category $category)
    {
        $data = $request->validate([
            'category.title' => ['required'],
            'category.section_id' => ['required'],
            'category.parent_id' => ['nullable', Rule::prohibitedIf(fn() =>
                $request->input('category.parent_id') == $category->id)
            ]
        ]);

        $category->fill($data['category']);
        $category->save();

        Toast::info(__('Category was saved'));

        return redirect()->route('platform.categories');
    }

    /**
     * @return RedirectResponse
     * @throws Exception
     *
     */
    public function remove(Category $category)
    {
        $category->delete();

        Toast::info(__('Category was removed'));

        return redirect()->route('platform.categories');
    }
}
