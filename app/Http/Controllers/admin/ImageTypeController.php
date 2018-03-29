<?php

namespace Admin;

use BaseController, App\Models\ImageType, App\Models\Category, Illuminate\Support\Facades\Input, View, Redirect;

class ImageTypeController extends BaseController
{
    public function index()
    {
        $imageTypes = ImageType::with('categories')->orderBy('name', 'ASC')->paginate(15);

        return View::make('admin.imageType.index', compact('imageTypes'));
    }

    public function create()
    {
        $categoryList = Category::all();
        $selectedCategories = collect([]);

        return View::make('admin.imageType.create', compact('categoryList', 'selectedCategories'));
    }

    public function store()
    {
        $imageType = new ImageType(Input::all());

        $selected_categories = Input::get('categories');
        if(is_array($selected_categories)) {
            $imageType->categories()->sync($selected_categories);
        }

        if($imageType->save()) {
            return Redirect::route('admin.imageType.index')->with('success','Image Type saved.');
        }

        return Redirect::back()->withErrors($imageType->getErrors())->withInput();
    }

    public function edit($id)
    {
        $imageType = ImageType::findOrFail($id);
        $categoryList = Category::all();
        $selectedCategories = $imageType->categories()->pluck('categories.name','categories.id');

        return View::make('admin.imageType.edit', compact('imageType', 'categoryList', 'selectedCategories'));
    }

    public function update($id)
    {
        $imageType = ImageType::findOrFail($id);

        $selected_categories = Input::get('categories');
        if(is_array($selected_categories)) {
            $imageType->categories()->sync($selected_categories);
        }

        if($imageType->update(Input::all())) {
            return Redirect::route('admin.imageType.index')->with('success', 'Image Type updated.');
        }

        return Redirect::back()->withErrors($imageType->getErrors())->withInput();
    }

    public function destroy($id)
    {
        ImageType::destroy($id);

        return Redirect::route('admin.imageType.index')->with('success', 'Image Type deleted.');
    }
}