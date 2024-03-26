<?php

namespace App\Models\Backend;

use App\Helpers\ImageUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Vendor extends Model
{
    use HasFactory;

    public $table = "vendors";
    public $guarded = [];

    public function updateBanner(){

        $path = $this->banner; // old banner before update

        if (request()->hasFile("banner")) {

            $vendorsPath = 'uploads/vendors';
            makeDir($vendorsPath);

            $fileInfo = ImageUpload::update([
                'file' => request()->file('banner'),
                "storagePath" => $vendorsPath,
                "old_image" => $this->banner,
                "default" => $this->banner,
                "height" => null,
                "width" => 800,
                "quality" => 100
            ]);

            $path = $fileInfo['file_path'];
        }

        return $path;
    }
}
