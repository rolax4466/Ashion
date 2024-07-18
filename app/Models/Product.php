<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url',
        'category_id' // Include category_id if it's a foreign key in your database schema
    ];

    // Explicitly specify the table name if it doesn't match the model name in StudlyCase
    protected $table = 'products';

    // Define the relationship between Product and Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Optional: Define the inverse of the relationship if needed elsewhere
    public function products()
    {
        return $this->hasMany(Product::class); // This assumes a many-to-many relationship, adjust according to your actual relationship type
    }
}
