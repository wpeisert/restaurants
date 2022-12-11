<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private const MAX_PER_PAGE = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->orderBy('sortby')->paginate(self::MAX_PER_PAGE);
        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * self::MAX_PER_PAGE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $params = $request->all();
        $params['image'] = $this->storeImage($request);
        $category = Category::create($params);

        //CategoryCreatedEvent::dispatch($category);

        return redirect()->route('categories.index')
            ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $params = $request->all();
        $params['image'] = $category->image;
        $newImageName = $this->storeImage($request);
        if ($newImageName || array_key_exists('image_delete', $params)) {
            $this->deleteImage($category->image);
            $params['image'] = $newImageName;
        }

        $category->update($params);

        return redirect()->route('categories.index')
            ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->deleteImage($category->image);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success','Category deleted successfully');
    }

    private function storeImage(Request $request): string
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $imageName = $image->hashName();
            $image->move(public_path('images'), $imageName);
            return $imageName;
        }

        return '';
    }

    private function deleteImage(string $imageName)
    {
        if ($imageName) {
            File::delete(public_path("images/$imageName"));
        }
    }
}
