<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\UploadedFile;

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
