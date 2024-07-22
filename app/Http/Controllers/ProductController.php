<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\ValidationException;


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
    // Fetch categories from the database
    $categories = Category::all();

    // Pass the categories to the view
    return view('admin.add-product', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    

     public function store(Request $request)
     {
         try {
             // Validate incoming request data
             $productData = $request->validate([
                 'name' => 'required|string|max:255',
                 'description' => 'required|string',
                 'price' => 'required|numeric|min:0|max:99999.99', // Ensure price is numeric and within a reasonable range
                 'units_in_stock' => 'required|numeric|min:0', // Ensure units_in_stock is numeric and non-negative
                 'category_id' => 'required|integer|exists:categories,id', // Validate category selection
                 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image file validation
             ]);
     
             // Check if there is an existing product with the same name
             $existingProduct = Product::where('name', $productData['name'])->first();
             if ($existingProduct) {
                 return redirect()->back()->with('error', 'Product already exists');
             }
     
             // Handle file upload
             if ($request->hasFile('image')) {
                 $image = $request->file('image');
     
                 // Ensure the directory exists
                 $directory = 'public/product-images';
                 if (!Storage::exists($directory)) {
                     Storage::makeDirectory($directory);
                 }
     
                 // Store file in 'storage/app/public/product-images' folder
                 $imagePath = $image->store('product-images', 'public');
     
                 // Set image URL in product data
                 $productData['image_url'] = $imagePath;
             }
     
             // Create the product with validated data
             Product::create($productData);
     
             // Redirect to the admin products page with a success message
             return redirect()->route('admin.products')->with('success', 'Product created successfully');
         } catch (ValidationException $e) {
             // Handle validation errors
             return redirect()->back()->withErrors($e->validator)->withInput();
         } catch (\Exception $e) {
             // Handle other errors and display them on screen
             return redirect()->back()->with('error', 'An error occurred while creating the product: ' . $e->getMessage());
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
