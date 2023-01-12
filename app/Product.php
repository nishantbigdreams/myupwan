<?php

namespace App;

use App\Traits\CacheTrait;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Product extends Model
{

    use Searchable, CacheTrait, SoftDeletes;

    protected $fillable = ['sku','id','name','category','description','details','model','similar_products','base_price','sell_price','data','combo_qty','combo_discount','gst','price_without_gst','video_url','delevery_charge','is_variations','variation_data','used_variation','product_weight','unit','home_best_sellers','home_recent_arrivals','alt_name'
    ];
/*    protected $appends = ['wish_list'];*/

    public function featuredImage()
    {
        return $this->hasOne(Media::class)->where('type', 'featured')
                ->orderBy('id','desc');
    }
    public function featuredImage2()
    {
        return $this->hasOne(Media::class)->where('type', 'featured2')
                ->orderBy('id','desc');
    }
    public function fImage()
    {
        return $this->hasOne(Media::class)->where('type', 'featured')
                ->orderBy('id','desc');
    }

    public function gallerImages()
    {
        return $this->hasMany(Media::class)->where('type', 'gallery');
    }

    public function questionAndAnswer()
    {
        return $this->hasMany(QuesAns::class)->orderBy('id', 'desc');
    }

    public function parentCategory()
    {   
        $category = Category::with('parentCategory')->where('name', $this->category)->first();
        if ($category) {
            if ($category->parentCategory) {
                return $category->parentCategory;
            }
        }
        return null;
    }

    public function similarProducts()
    {
        return Product::whereIn('sku', explode(',', $this->similar_products))->get();
    }

    public function getInStockAttribute($value)
    {
        if ($value <= 0) {
            return '<span class="text-danger">Out of Stock</span>';
        }
        return $value.' left';
    }

    /**
     * Scope a query to only include in stock products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInStock($query)
    {
        return $query->where('in_stock', '>=', 0);
    }

    /**
     * Scope a query to newest.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function setModelAttribute($value)
    {
        $this->attributes['model'] = str_replace('#', '_', $value);
    }
    public function getWishListAttribute()
    {
        $uid ='';
        if(auth::user()){
           $uid= auth::user()->id;
        }
        else{
            $uid =0;
        }

        return WishlistModel::where('p_id',$this->id)->where('cust_id',$uid)->count();
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_permanent_deleted', function (Builder $builder) {
            $builder->where('parmanent_deleted_at', null);
        });
    }

    //limit product data sent to algolia

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'category' => $this->category,
            'model' => $this->model,
        ];
    }

}
