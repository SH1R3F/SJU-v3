<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleService
{

    /**
     * Create a new article
     */
    public function create(array $data)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['news_date']);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        // Save images in storage instead of base64.
        $pattern = '/<img\s+[^>]*src="data:image\/[a-zA-Z]+;base64,[^"]+"[^>]*>/';
        preg_match_all($pattern, $data['content_ar'], $matches);
        foreach ($matches[0] as $image) {
            $path = upload_base64_image($image, "uploads/images/wysiwyg/" . $data['news_date']);
            $url = Storage::url($path);
            $img = "<img src='$url' />";
            $data['content_ar'] = str_replace($image, $img, $data['content_ar']);
        }

        preg_match_all($pattern, $data['content_en'], $matches);
        foreach ($matches[0] as $image) {
            $path = upload_base64_image($image, "uploads/images/wysiwyg/" . $data['news_date']);
            $url = Storage::url($path);
            $img = "<img src='$url' />";
            $data['content_en'] = str_replace($image, $img, $data['content_en']);
        }

        return Article::create($data);
    }

    /**
     * Update an existing article
     */
    public function update(array $data, Article $article)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['news_date'], $article->images);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        // Save images in storage instead of base64.
        $pattern = '/<img\s+[^>]*src="data:image\/[a-zA-Z]+;base64,[^"]+"[^>]*>/';
        preg_match_all($pattern, $data['content_ar'], $matches);
        foreach ($matches[0] as $image) {
            $path = upload_base64_image($image, "uploads/images/wysiwyg/" . $data['news_date']);
            $url = Storage::url($path);
            $img = "<img src='$url' />";
            $data['content_ar'] = str_replace($image, $img, $data['content_ar']);
        }

        preg_match_all($pattern, $data['content_en'], $matches);
        foreach ($matches[0] as $image) {
            $path = upload_base64_image($image, "uploads/images/wysiwyg/" . $data['news_date']);
            $url = Storage::url($path);
            $img = "<img src='$url' />";
            $data['content_en'] = str_replace($image, $img, $data['content_en']);
        }

        $article->update($data);
    }


    /**
     * Handle article image calculations
     */
    private function handleImages(array $images, $date, array $oldies = [])
    {
        // Should I delete previous images and reset them?

        $imgs = [];
        foreach ($images as $img) {
            if (str_starts_with($img, 'data:image')) {
                $path = upload_base64_image($img, "uploads/images/$date");
                array_push($imgs, $path);
                continue;
            }

            if ($img instanceof UploadedFile) {
                $path = $img->store("uploads/images/$date");
                array_push($imgs, $path);
                continue;
            }

            // Previous photos? [urls]
            foreach ($oldies as $oldie) {
                if (strpos($img, $oldie)) {
                    array_push($imgs, $oldie);
                    break;
                }
            }
        }
        return $imgs;
    }
}
