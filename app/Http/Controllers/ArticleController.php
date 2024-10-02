<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
 
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->except('index', 'detail');
    }

    public function index()
    {
        $articles = Article::latest()->paginate(12);

        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail', [
            'article' => $article
        ]);
    }

    public function add()
    {
        $categories = Category::all();

        return view('articles.add', [
            'categories' => $categories
        ]);
    }

    // public function create(Request $request)
    // {
    //     $article = new Article;

    //     $validator = validator(request()->all(), [
    //         'title' => 'required',
    //         'body' => 'required',
    //         'category_id' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',

    //     ]);
    //     if ($validator->fails()) {
    //         return back()->withErrors($validator);
    //     }

    //     if ($request->hasFile('image')) {


    //         try {
    //             $image = $request->file('image');
    //             $image_name = time() . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $image_name);

    //             $image = $image_name;
    //         } catch (\Exception $e) {
    //             // Handle the error
    //             return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
    //         }
    //     }

    //     $article->title = request()->title;
    //     $article->body = request()->body;
    //     $article->category_id = request()->category_id;
    //     $article->user_id = \Illuminate\Support\Facades\Auth::user()->id;
    //     $article->image = $image;
    //     $article->save();

    //     return redirect("/articles")->with('info', 'Article created');
    // }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = validator($request->all(), [
            'title' => 'required|string|max:255', // Added string and max length validation
            'body' => 'required|string', // Added string validation
            'category_option' => 'required', // Ensure the category option is selected
            'category_id' => 'required_if:category_option,existing', // Required only if existing category is selected
            'new_category_name' => 'nullable|string|max:255', // Validate new category name
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Fixed max size to 2048 KB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Create a new article instance
        $article = new Article;

        // Handle image upload if present
        $imageName = null; // Initialize image name
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique image name
                $image->move(public_path('images'), $imageName); // Move the image to the public/images directory
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Image upload failed. Please try again.']);
            }
        }

        // Handle categories based on user selection
        if ($request->category_option === 'new' && $request->new_category_name) {
            // Create or find the new category
            $newCategory = Category::firstOrCreate(['name' => $request->new_category_name]);
            $article->category_id = $newCategory->id; // Use the new category ID
        } else {
            // Use the existing category ID
            $article->category_id = $request->category_id;
        }

        // Fill in the article's details
        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = \Illuminate\Support\Facades\Auth::id(); // Use the Auth facade directly
        $article->image = $imageName; // Assign the image name to the article

        // Save the article to the database
        $article->save();

        return redirect("/articles")->with('info', 'Article created successfully');
    }


    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect("/articles")->with('info', 'Article deleted');
        } else {
            return back()->with('error', 'Unauthorize to delete this article');
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        if (Gate::allows('article-delete', $article)) {
            return view('articles.edit', [
                'article' => $article,
                'categories' => $categories,
            ]);
        } else {
            return back()->with('error', 'Unauthorize to edit this article');
        }
    }


    // public function update($id)
    // {
    //     $article = Article::find($id);

    //     // Validate the request
    //     $validator = validator(request()->all(), [
    //         'title' => 'required',
    //         'body' => 'required',
    //         'category_id' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the new image
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator);
    //     }

    //     // Update the article fields
    //     $article->title = request()->title;
    //     $article->body = request()->body;
    //     $article->category_id = request()->category_id;

    //     // Handle image upload
    //     if (request()->hasFile('image')) {
    //         // Delete the old image if it exists
    //         $oldImage = public_path('images/' . $article->image);
    //         if (file_exists($oldImage)) {
    //             unlink($oldImage); // Delete the old image
    //         }

    //         // Generate a random integer for the new image name
    //         $randomInt = rand(10000, 99999); // Generate a random integer

    //         // Get the file extension of the uploaded image
    //         $extension = request()->file('image')->getClientOriginalExtension();

    //         // Create the new image name
    //         $newImageName = $randomInt . '.' . $extension;

    //         // Define the path where the image will be uploaded
    //         $destinationPath = public_path('images'); // Set the destination path to public/images

    //         // Move the uploaded file to the public/images directory
    //         request()->file('image')->move($destinationPath, $newImageName);

    //         // Update the article image path in the database
    //         $article->image = $newImageName; // Update the article image name
    //     }

    //     $article->save(); // Save the article with the new image name

    //     return redirect("/articles/detail/$article->id")->with('info', 'Article updated');
    // }
    public function update($id)
    {
        $article = Article::find($id);

        // Validate the request
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_option' => 'required', // Ensure a category option is selected
            'new_category_name' => 'nullable|string|max:255',
            'category_id' => 'required_if:category_option,existing', // Ensure category ID is present if selecting existing
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the new image
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Update the article fields
        $article->title = request()->title;
        $article->body = request()->body;

        // Check which category option was selected
        if (request()->category_option === 'new' && request()->new_category_name) {
            // If a new category name is provided, create a new category
            $newCategory = Category::firstOrCreate(['name' => request()->new_category_name]);
            $article->category_id = $newCategory->id; // Use the new category ID
        } else {
            // Use the selected existing category
            $article->category_id = request()->category_id;
        }

        // Handle image upload
        if (request()->hasFile('image')) {
            // Delete the old image if it exists
            $oldImage = public_path('images/' . $article->image);
            if (file_exists($oldImage)) {
                unlink($oldImage); // Delete the old image
            }

            // Generate a random integer for the new image name
            $randomInt = rand(10000, 99999);

            // Get the file extension of the uploaded image
            $extension = request()->file('image')->getClientOriginalExtension();

            // Create the new image name
            $newImageName = $randomInt . '.' . $extension;

            // Define the path where the image will be uploaded
            $destinationPath = public_path('images');

            // Move the uploaded file to the public/images directory
            request()->file('image')->move($destinationPath, $newImageName);

            // Update the article image path in the database
            $article->image = $newImageName; // Update the article image name
        }

        $article->save(); // Save the article with the new image name

        return redirect("/articles/detail/$article->id")->with('info', 'Article updated');
    }
}

