<?php

namespace App\Services;

use App\Models\Course\Course;

class CourseService
{

    /**
     * Create a new course
     */
    public function create(array $data)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['date_from']);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        // Set course number
        $data['course_number'] = $this->courseNumber();
        return Course::create($data);
    }

    /**
     * Update an existing course
     */
    public function update(array $data, Course $course)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['date_from'], $course->images);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        $course->update($data);
    }


    /**
     * Handle course image calculations
     */
    private function handleImages(array $images, $date_from, array $oldies = [])
    {
        // Should I delete previous images and reset them?

        $imgs = [];
        foreach ($images as $img) {
            if (str_starts_with($img, 'data:image')) {
                $path = upload_base64_image($img, "courses/images/$date_from");
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

    /**
     * Generate course number
     */
    private function courseNumber()
    {
        $last = Course::orderBy('course_number', 'DESC')->first();
        if (!$last || !$last->course_number) return 'SJU-0001';

        $num = intval(explode('-', $last->course_number)[1]);
        return "SJU-" . str_pad($num + 1, 4, '0', STR_PAD_LEFT);
    }
}
