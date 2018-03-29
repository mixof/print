<?php

namespace Admin;

use BaseController, App\Models\Category, App\Models\ImageType, Illuminate\Support\Facades\Input, View, Redirect,App\Models\Photo;

class CategoryController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$counts = [];
		$categoryList = Category::where('parent_id', '==', 0)->orderBy('name', 'ASC')->paginate(15);
		foreach($categoryList as $category){
			$counts[$category->id] = Photo::inCategory($category->id)->count();
		}

		return View::make('admin.category.index', compact('categoryList','counts'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$imageTypes = ImageType::all();
		$selectedTypes = collect([]);
		$category = new Category();

		return View::make('admin.category.create', compact('imageTypes', 'selectedTypes', 'category'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$category = new Category(Input::all());

		if ($category->save()) {
			$selected_image_types = Input::get('imageTypes');
			if(is_array($selected_image_types)) {
				$category->imageTypes()->sync($selected_image_types);
			}
			return Redirect::route('admin.category.index')->with('success', 'Category saved.');
		}

		return Redirect::back()->withErrors($category->getErrors())->withInput();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::findOrFail($id);
		$categories = Category::all();
		$imageTypes = ImageType::all();
		$selectedTypes = $category->imageTypes()->pluck('image_types.name', 'image_types.id');

		return View::make('admin.category.edit', compact('category', 'categories', 'imageTypes', 'selectedTypes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Category::findOrFail($id);
		$category->fill(Input::all());

		$selected_image_types = Input::get('imageTypes');
		if(is_array($selected_image_types)) {
			$category->imageTypes()->sync($selected_image_types);
		}

		if ($category->save()) {
			return Redirect::route('admin.category.index')->with('success', 'Category updated.');
		}

		return Redirect::back()->withErrors($category->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Category::destroy($id);

		return Redirect::route('admin.category.index')->with('success', 'Category deleted.');
	}

	public function addSubcategory($id) {
		$categoryList = Category::where('parent_id', '==', 0)->orderBy('name')->lists('name', 'id');
		$category = Category::findOrFail($id);

		return View::make('admin.category.addSubcategory', compact('categoryList', 'category'));
	}

	public function saveSubcategory($id) {
		$parentCategoryId = $id;
		$subcategoryId = Input::get('subcategories');
		$subcategory = Category::findOrFail($subcategoryId);
		$subcategory->parent_id = $parentCategoryId;

		if($subcategory->save()) {
			return Redirect::route('admin.category.edit', $id)->with('success', 'Subcategory added.');
		}

		return Redirect::back()->withErrors($subcategory->getErrors())->withInput();
	}

	public function removeSubcategory($subId, $categoryId)
	{
		$subcategory = Category::findOrFail($subId);
		$subcategory->parent_id = 0;
		if($subcategory->save()) {
			return Redirect::route('admin.category.edit', $categoryId)->with('success', 'Subcategory removed.');
		}

		Redirect::back()->withErrors($subcategory->getErrors())->withInput();
	}
}
