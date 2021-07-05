<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat() {

        /* $categories = Category::all(); */
        $categories = Category::paginate(3);

       /*  $categories = DB::table('categories')->get(); */
       /*  $categories = DB::table('categories')
                        ->join('users','categories.user_id', 'users.id')
                        ->select('categories.*','users.name')
                        ->latest()->get();
            //Relacionamento utilizando query builder

 */

        $trachCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories'), compact('trachCat'));
    }

    public function AddCat(Request $request) {

        $validated = $request->validate(

            [
                'category_name' => 'required|unique:categories|max:255'
            ],
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.unique' => 'Please Input different Category Name',
                'category_name.max' => 'Category Must Contain Max 255 Chars'
            ],
        );

        /* Category::insert([
                'category_name'=> $request->category_name,
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now()
            ]); */

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

       /*  $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        DB::table('categories')->insert($data); */

        return Redirect()->back()->with('success', "Category insert successful");
    }

    public function EditCategory($id) {
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
    }

    public function UpdateCategory(Request $request, $id) {

        $category = Category::find($id);

        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', "Category updated");
    }

    public function deleteCategory($id) {
        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', "Category Deleted");
    }

    public function RestoreCategory($id){
        $deletes = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success', "Category Restored");
    }
}
