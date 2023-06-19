<?php

namespace App\Services;

use ArPHP\I18N\Arabic;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        if (empty($invitation->qr_position) || $invitation->qr_position == "none") {
            $img
                ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                    $font->file(resource_path("fonts/invitation-font.ttf"));
                    $font->size($invitation->variables['fontsize']);
                    $font->color($invitation->variables['fontcolor']);
                    $font->align('center');
                })
                ->save(storage_path("app/public/{$invitation->preview}"));
        } else {
            // Generate the QR code
            $qr = QrCode::size($invitation->qr_size ?? 200)
                ->format('png')
                ->errorCorrection('M')
                ->generate(url(''));

            Storage::put($qr_path = str_replace('.jpg', '-qr.jpg', $invitation->preview), $qr);

            $position_x = empty($invitation->qr_position_x) ? 0 : $invitation->qr_position_x;
            $position_y = empty($invitation->qr_position_y) ? 0 : $invitation->qr_position_y;
            $img
                ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                    $font->file(resource_path("fonts/invitation-font.ttf"));
                    $font->size($invitation->variables['fontsize']);
                    $font->color($invitation->variables['fontcolor']);
                    $font->align('center');
                })
                ->insert(storage_path("app/public/$qr_path"), $invitation->qr_position, $position_x, $position_y)
                ->save(storage_path("app/public/{$invitation->preview}"));
        }
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
        $code   = Str::random(40);

        $x_position = $invitation->variables['width_type'] == 'center' ? ($img->width() / 2) : ($img->width() - $invitation->variables['width']);

        if (empty($invitation->qr_position) || $invitation->qr_position == "none") {
            $img
                ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                    $font->file(resource_path("fonts/invitation-font.ttf"));
                    $font->size($invitation->variables['fontsize']);
                    $font->color($invitation->variables['fontcolor']);
                    $font->align('center');
                })
                ->save(storage_path("app/public/$path"));
        } else {
            // Generate the QR code
            $qr = QrCode::size($invitation->qr_size ?? 200)
                ->format('png')
                ->errorCorrection('M')
                ->generate(route('invitation.attend', $code));

            Storage::put($qr_path = "invitations/results/qr-$code.png", $qr);

            $position_x = empty($invitation->qr_position_x) ? 0 : $invitation->qr_position_x;
            $position_y = empty($invitation->qr_position_y) ? 0 : $invitation->qr_position_y;

            $img
                ->text($text, $x_position, $invitation->variables['height'], function ($font) use ($invitation) {
                    $font->file(resource_path("fonts/invitation-font.ttf"));
                    $font->size($invitation->variables['fontsize']);
                    $font->color($invitation->variables['fontcolor']);
                    $font->align('center');
                })
                ->insert(storage_path("app/public/$qr_path"), $invitation->qr_position, $position_x, $position_y)
                ->save(storage_path("app/public/$path"));
        }

        return [
            'path' => $path,
            'code' => $code
        ];
    }
}
