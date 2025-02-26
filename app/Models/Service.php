<?php

namespace Modules\ServiceModule\Models;

use App\Traits\Attributes\HasPrimaryImage;
use App\Traits\HasTranslatableWithJsonEscape;
use App\Traits\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CartModule\Models\CartItem;
use Modules\CategoryModule\Models\Category;
use Spatie\MediaLibrary\HasMedia;


class Service extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslatableWithJsonEscape;
    use HasActiveScope;
    use HasPrimaryImage;


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'category_id'
    ];
    public $translatable = [
        'name',
        'description',
    ];

    public function cartItems()
    {
        return $this->morphMany(CartItem::class, 'itemable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // protected static function newFactory(): ServiceFactory
    // {
    //     // return ServiceFactory::new();
    // }
}
