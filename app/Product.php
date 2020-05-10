<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','description'];

    protected $guarded = [];

  //  protected $appends = ['image_path'];

    public function category (){
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    }

    public function getImagePathAttribute()
{
    return asset('public/uploads/products/' . $this->image);
}

    public function getProfitPrecentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $prodit_precent = $profit * 100 / $this->purchase_price;
        return number_format($prodit_precent,2);
    }

}
