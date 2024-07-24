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
                 'price' => 'required|numeric|min:0|max:99999.99',
                 'stock_quantity' => 'required|numeric|min:0',
                 'category_id' => 'required|integer|exists:categories,id',
                 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                 $directory = '/product-images';
                 if (!Storage::exists($directory)) {
                     Storage::makeDirectory($directory);
                 }
     
                 // Get the number of existing images in the directory
                 $files = Storage::files($directory);
                 $imageCount = count($files) + 1;
                 $imageName = 'productimg' . $imageCount . '.' . $image->getClientOriginalExtension();
     
                 // Store file in 'storage/app/public/product-images' folder with the new name
                 $imagePath = $image->storeAs('product-images', $imageName, 'public');
     
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
        //find the product
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit-product', compact('product', 'categories'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the product
            $product = Product::findOrFail($id);
    
            // Validate the incoming data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0|max:99999.99',
                'stock_quantity' => 'required|numeric|min:0',
                'category_id' => 'required|integer|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Update the product
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock_quantity = $request->input('stock_quantity');
            $product->category_id = $request->input('category_id');
    
            // Image
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                    Storage::disk('public')->delete($product->image_url);
                }
    
                // Ensure the directory exists
                $directory = 'product-images';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
    
                // Store the new image
                $imagePath = $request->file('image')->store($directory, 'public');
                $product->image_url = $imagePath;
            }
    
            $product->save();
    
            // Redirect to the product page with a success message
            return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->route('admin.edit-product', $id)->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('admin.edit-product', $id)->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
