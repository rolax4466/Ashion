<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        $categories=Category::all();
        return view('admin.products', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.add-product');
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
                 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image file validation
             ]);
     
             // Handle file upload
             if ($request->hasFile('image')) {
                 $image = $request->file('image');
                 
                 // Generate unique file name based on existing files
                 $imageName = 'categoryimg' . (count(Storage::files('public/category-images')) + 1) . '.' . $image->getClientOriginalExtension();
                 
                 // Store file in 'storage/app/public/category-images' folder
                 $imagePath = $image->storeAs('public/category-images', $imageName);
                 
                 // Get URL of stored file
                 $imageUrl = Storage::url($imagePath);
                 
                 // Set image URL in category data
                 $categoryData['image_url'] = $imageUrl;
             }
     
             // Create a new Category instance with validated data
             Category::create($categoryData);
     
             // Redirect to the admin products page with a success message
             return redirect()->route('admin.products')->with('success', 'Category created successfully');
             
         } catch (\Exception $e) {
             // Handle error...
             // Log the error for debugging purposes if needed
             \Log::error('Error creating category: ' . $e->getMessage());
     
             // Redirect back with an error message
             return redirect()->back()->with('error', 'An error occurred while creating the category');
         }
     }
     
      
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
