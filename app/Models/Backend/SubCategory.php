<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Backend\Category;

class SubCategory extends Model
{
    use HasFactory;

    public $table = 'sub-categories';
    public $guarded = [];

    /**
     * Get the category associated with the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get all of the childCategories for the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id', 'id');
    }
}
