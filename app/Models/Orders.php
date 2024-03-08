<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'email',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_address_3',
        'country_code',
        'zip_postal_code',
        // Add other columns from your 'Ooders' table here
    ]; 
  
}
