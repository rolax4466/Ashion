<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description',
        'image_url' // If categories have images
    ];

    // Explicitly specify the table name if it doesn't match the model name in StudlyCase
    protected $table = 'categories';

    // Define the relationship between Category and Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
