<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;



use Illuminate\Http\Request;

class CategoryController extends Controller
{
   /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate incoming request data including image upload
            $categoryData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image file validation (nullable if not required)
            ]);
    
            // Check if there is an existing category with the same name
            $existingCategory = Category::where('name', $categoryData['name'])->first();
            if ($existingCategory) {
                return redirect()->back()->with('error', 'Category already exists');
            }
    
            // Handle file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                // Ensure the directory exists
                $directory = '/category-images';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
    
                // Get the number of existing images in the directory
                $files = Storage::files($directory);
                $imageCount = count($files) + 1;
                $imageName = 'categoryimg' . $imageCount . '.' . $image->getClientOriginalExtension();
    
                // Store the file in 'storage/app/public/category-images' folder with the new name
                $imagePath = $image->storeAs('category-images', $imageName, 'public');
    
                // Set image URL in category data
                $categoryData['image_url'] = $imagePath;
            }
    
            // Create the category with validated data
            Category::create($categoryData);
    
            // Redirect to the admin products page with a success message
            return redirect()->route('admin.products')->with('success', 'Category created successfully');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the category: ' . $e->getMessage());
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    try {
        $category = Category::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the category
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                Storage::disk('public')->delete($category->image_url);
            }

            // Ensure the directory exists
            $directory = 'category-images';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Store the new image
            $imagePath = $request->file('image')->store($directory, 'public');
            $category->image_url = $imagePath;
        }

        $category->save();

        // Redirect to the product page with a success message
        return redirect()->route('admin.products')->with('success', 'Category updated successfully!');
    } catch (ValidationException $e) {
        // Handle validation errors
        return redirect()->route('admin.edit-category', $id)->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        // Handle the error
        return redirect()->route('admin.edit-category', $id)->with('error', 'An error occurred while updating the category: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(string $id)
     {
         try {
             // Find the category to be deleted
             $category = Category::findOrFail($id);
 
             // Check if the category has an associated image
             if ($category->image_url && Storage::disk('public')->exists($category->image_url)) {
                 // Delete the image from storage
                 Storage::disk('public')->delete($category->image_url);
             }
              // Delete related products
            Product::where('category_id', $id)->delete();
 
             // Delete the category record from the database
             $category->delete(); // Make sure this is called on the instance
          


             // Redirect to the products page with a success message
             return redirect()->route('admin.products')->with('success', 'Category deleted successfully!');
 
         } catch (\Exception $e) {
             // Redirect back with an error message if something goes wrong
             return redirect()->route('admin.products')->with('error', 'An error occurred while deleting the category: ' . $e->getMessage());
         }
     }
}
