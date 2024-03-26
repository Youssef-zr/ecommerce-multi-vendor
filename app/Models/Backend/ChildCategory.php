<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    public $table = 'child-categories';
    public $guarded = [];

    /**
     * Get the mainCategory associated with the ChildCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    /**
     * Get the subCategory associated with the ChildCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }
}
