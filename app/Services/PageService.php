<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Url;

class PageService
{

    /**
     * Prepare press page group html
     * 
     * @param int $group
     * @param string $content
     * @return string
     */
    public function preparePressGroup(int $group, $content)
    {
        $html = '<div class="row text-center mt-3" style="width: 100%;margin: auto">';
        $urls = Url::where('status', 1)->where('group', $group)->get();
        $urls->each(function ($url) use (&$html) {
            $image = Storage::url($url->image);
            $html .= <<<EOT
                    <div class="col-lg-3" style="border: 1px solid #CCC;vertical-align: middle;height: 150px">
                            <a href="$url->link" target="$url->target">
                                <img class="img-fluid p-3" style="width: 230px;height:100%;max-height: 150px" src="$image" alt="$url->title">
                            </a>
                    </div>
                EOT;
        });
        $html .= '</div>';
        return str_replace("[URLS_GROUP_$group]", $html, $content);
    }
}
