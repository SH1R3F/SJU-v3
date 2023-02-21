<?php

namespace App\Services;

use Mpdf\Mpdf;
use ReflectionClass;
use App\Models\Course\Course;
use App\Models\Course\Template;
use App\Models\Course\Certificate;
use App\Notifications\SendCertificate;

class CertificateService
{
    /**
     * Generate certificate for a user
     * 
     * @param mixed  $user
     * @param \App\Models\Course\Category $course
     */
    public function create($user, Course $course)
    {
        $template = $course->template;
        if (!$template) return;

        $code = $this->registerCertificate($user, $course);

        $this->generateCertificate($course, $user, $code);
    }

    /**
     * Generate certificate
     */
    public function generateCertificate($course, $user, $code, $email = false)
    {
        $template = $course->template;
        // Mpdf Work
        $mpdf = new Mpdf([
            'mode'          => $template->mode,
            'format'        => $template->layout,
            'fontDir'       => [config('pdf.custom_font_dir')],
            'fontdata'      => config('pdf.custom_font_data'),
            'unAGlyphs'     => true,
        ]);

        $mpdf->SetDirectionality($template->mode == 'ar' ? 'rtl' : 'ltr');
        $mpdf->SetDocTemplate(storage_path("app/public/{$template->file}"), 1);

        $html = $this->fields($template, $user);
        $html .= $this->qrCode($template, $code);

        try {
            $mpdf->WriteHTML($html);
            if ($email) {
                $reflect = new ReflectionClass($user);
                $mpdf->Output($path = "storage/certificates/{$reflect->getShortName()}-{$user->id}-{$course->title_ar}.pdf", 'F');
                return $path;
            } else {
                $mpdf->Output("{$course->title_ar}.pdf", 'I');
            }
        } catch (\Exception $e) {
            logger("___________________________ERROR GENERATING CERTIFICATE__________________________");
            logger($e->getMessage());
            logger("______________________________________{$template->id}___________________________________________");
        }
    }

    /**
     * Register certificate for later verification
     */
    private function registerCertificate($user, $course)
    {
        if ($user->certificates()->where('course_id', $course->id)->count()) {
            return $user->certificates()->where('course_id', $course->id)->first()->code;
        }

        // First time ...

        $hash = uniqid();
        $user->certificates()->create([
            'code' => $hash,
            'course_id' => $course->id
        ]);

        // Also send email..
        $user->notify(new SendCertificate($hash, $course));

        return $hash;
    }

    /**
     * Prepare fields HTML
     * 
     * @param \App\Models\Course\Template  $template
     * @param mixed  $user
     */
    private function fields(Template $template, $user)
    {
        $setMaleOrFemaleTitle = '';
        if ($template->with_title) {
            switch ($user->gender) {
                case 'female':
                    $setMaleOrFemaleTitle = $template->female_title;
                    break;
                case 'male':
                    $setMaleOrFemaleTitle = $template->male_title;
                    break;
                case 1:
                    $setMaleOrFemaleTitle = $template->female_title;
                    break;
                default:
                    $setMaleOrFemaleTitle = $template->male_title;
                    break;
            }
        }

        $html = '';
        foreach ($template->variables ?? [] as $variable) {

            // Text value
            $text = $variable['field'];
            if ($variable['field'] === '{free_text}') $text = $variable['text'];
            if ($variable['field'] === '{اسم_المتدرب}') $text = "$setMaleOrFemaleTitle " . $user->fullNameAr;

            // Text positioning
            $position_y     = 'top: ' . $variable['height'] . 'mm; ';
            $position_fixed = 'width: 100%; text-align:center;';
            $position_x     = ($template->mode == 'ar' ? 'right' : 'left') . ': 0mm; ';
            if ($variable['width_type'] == 'specify') {
                $position_fixed = 'width: auto;';
                $position_x     = ($template->mode == 'ar' ? 'right' : 'left') . ': ' . $variable['width'] . 'mm; ';
            }

            $font_size      = $variable['fontsize'] . 'px';
            $font_color     = $variable['fontcolor'];
            $font_type      = $variable['fontfamily'] . ';';

            $html .= $text ? "<div style='position: absolute; $position_y $position_fixed $position_x'><span style='font-weight: bold; font-size: $font_size; font-family: $font_type; color: $font_color;'>$text</span></div>" : '';
        }
        return $html;
    }

    /**
     * Prepare QR code HTML
     * 
     * @param \App\Models\Course\Template  $template
     * @param string  $hash
     */
    private function QRCode(Template $template, $code)
    {
        if ($template->qr_position == 'none') return '';

        $margin_top = empty($template->qr_margin_top) ? 0 : $template->qr_margin_top;
        $margin_right = empty($template->qr_margin_right) ? 0 : $template->qr_margin_right;
        $margin_bottom = empty($template->qr_margin_bottom) ? 0 : $template->qr_margin_bottom;
        $margin_left = empty($template->qr_margin_left) ? 0 : $template->qr_margin_left;

        $position = $template->qr_position;
        $qr_image = asset('img/qrcode.jpg');
        $img = "<img src='$qr_image' style='width: 80px'/>";
        $validate_url = route('verify-certificate');
        $validatetxt   = ($template->mode == 'ar' ? 'right' : 'left') ? 'للتحقق من صحة الشهادة' : 'Validate certificate';

        return "<div style='text-align:center;margin-top: $margin_top;margin-right: $margin_left; margin-bottom: $margin_bottom; margin-left: $margin_right; position: absolute; $position'>$img<br><span style='font-size: 12px'>$validatetxt</span><br><span style='font-size: 12px;font-weight: bold'>$code</span><br><span  style='font-size: 12px'>$validate_url</span></div>";
    }
}
