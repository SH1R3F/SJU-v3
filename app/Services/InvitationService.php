<?php

namespace App\Services;

use ArPHP\I18N\Arabic;
use App\Models\Invitation;
use Illuminate\Support\Str;

class InvitationService
{
    /**
     * Update the invitation preview file
     * 
     * @param  \App\Models\Invitation  $invitation
     */
    public function preview(Invitation $invitation)
    {
        $img    = \Image::make(storage_path("app/public/{$invitation->preview}"));
        $arabic = new Arabic('Glyphs');
        $text   = $arabic->utf8Glyphs($invitation->variables['field']);

        $x_position = $invitation->variables['width_type'] == 'center' ? ($img->width() / 2) : ($img->width() - $invitation->variables['width']);

        $img
            ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                $font->file(resource_path("fonts/invitation-font.ttf"));
                $font->size($invitation->variables['fontsize']);
                $font->color($invitation->variables['fontcolor']);
                $font->align('center');
            })
            ->save(storage_path("app/public/{$invitation->preview}"));
    }


    /**
     * Create invitation for a specific name
     * 
     * @param string $name
     */
    public function create($name, $invitation)
    {
        // Create invitation image
        $img    = \Image::make(storage_path("app/public/{$invitation->file}"));
        $arabic = new Arabic('Glyphs');
        $text   = $arabic->utf8Glyphs($name);
        $file   = Str::slug($name);
        $path   = "invitations/results/{$invitation->id}-{$file}.png";

        $x_position = $invitation->variables['width_type'] == 'center' ? ($img->width() / 2) : ($img->width() - $invitation->variables['width']);
        $img
            ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                $font->file(resource_path("fonts/invitation-font.ttf"));
                $font->size($invitation->variables['fontsize']);
                $font->color($invitation->variables['fontcolor']);
                $font->align('center');
            })
            ->save(storage_path("app/public/$path"));

        return $path;
    }
}
