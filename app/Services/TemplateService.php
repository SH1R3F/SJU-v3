<?php

namespace App\Services;

use Mpdf\Mpdf;
use App\Models\Course\Template;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TemplateService
{
    /**
     * Create template
     *
     * @param array  $data
     */
    public function create(array $data)
    {
        $path = $data['file']->store("courses/templates");
        $data['preview'] = $data['file']->store("courses/templates/previews");
        $data['file'] = $path;

        // Create template
        $template = Template::create($data);

        // Prepare the preview file
        $this->preview($template);

        return $template;
    }

    /**
     * Update template
     *
     * @param array  $data
     * @param \App\Models\Course\Template  $template
     */
    public function update(array $data, Template $template)
    {
        // Delete old files and update new ones.
        if ($data['file'] instanceof UploadedFile) {
            Storage::delete($template->file ?? '', $template->preview ?? '');
            $data['preview'] = $data['file']->store("courses/templates/previews");
            $data['file'] = $data['file']->store("courses/templates");
        } else {
            Storage::delete($template->preview ?? '');
            Storage::copy($template->file, $data['preview'] = str_replace("courses/templates", "courses/templates/previews", $template->file));
            $data['file'] = $template->file;
        }

        // Update template
        $template->update($data);
        // Prepare the preview file
        $this->preview($template);
    }


    /**
     * Prepare the preview file
     *
     * @param \App\Models\Course\Template  $template
     */
    private function preview(Template $template)
    {
        // Mpdf Work
        $mpdf = new Mpdf([
            'mode'          => $template->mode,
            'format'        => $template->layout,
            'fontDir'       => [config('pdf.custom_font_dir')],
            'fontdata'      => config('pdf.custom_font_data'),
            'unAGlyphs'     => true,
        ]);

        $mpdf->SetDirectionality($template->mode == 'ar' ? 'rtl' : 'ltr');
        $mpdf->SetDocTemplate(storage_path("app/public/{$template->preview}"), 1);

        $html = $this->fields($template);
        $html .= $this->qrCode($template);

        try {
            $mpdf->WriteHTML($html);
            $mpdf->Output(storage_path("app/public/{$template->preview}"), \Mpdf\Output\Destination::FILE);
        } catch (\Exception $e) {
            logger("___________________________ERROR PREVIEWING TEMPLATE__________________________");
            logger($e->getMessage());
            logger("______________________________________________________________________________");
        }
    }


    /**
     * Prepare fields HTML
     *
     * @param \App\Models\Course\Template  $template
     */
    private function fields(Template $template)
    {
        $setMaleOrFemaleTitle = '';
        if ($template->with_title) {
            $or = ($template->mode == 'ar') ? 'أو' : 'Or';
            $setMaleOrFemaleTitle = "{{$template->male_title} {$or} {$template->female_title}}";
        }

        $html = '';
        foreach ($template->variables ?? [] as $variable) {

            // Text value
            $text = $variable['field'];
            if ($variable['field'] === '{free_text}') $text = $variable['text'];
            if ($variable['field'] === '{اسم_المتدرب}') $text = "$setMaleOrFemaleTitle {اسم_المتدرب}";

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
            $font_type      = $variable['fontfamily'];

            if ($text) {
                $html .= <<<EOD
                <div style="position: absolute; $position_y $position_fixed $position_x"><span style="font-family: $font_type; font-weight: bold; font-size: $font_size; color: $font_color;">$text</span></div>
                EOD;
            }
        }
        return $html;
    }

    /**
     * Prepare QR code HTML
     *
     * @param \App\Models\Course\Template  $template
     */
    private function QRCode(Template $template)
    {
        if ($template->qr_position == "none") return '';

        $margin_top = empty($template->qr_margin_top) ? 0 : $template->qr_margin_top;
        $margin_right = empty($template->qr_margin_right) ? 0 : $template->qr_margin_right;
        $margin_bottom = empty($template->qr_margin_bottom) ? 0 : $template->qr_margin_bottom;
        $margin_left = empty($template->qr_margin_left) ? 0 : $template->qr_margin_left;

        $position = $template->qr_position;
        $qr_image = asset('img/qrcode.jpg');
        $img = "<img src='$qr_image' style='width: 80px'/>";
        $validate_url = route('verify-certificate');
        $validatetxt   = ($template->mode == 'ar' ? 'right' : 'left') ? 'للتحقق من صحة الشهادة' : 'Validate certificate';

        return "<div style='text-align:center;margin-top: $margin_top;margin-right: $margin_left; margin-bottom: $margin_bottom; margin-left: $margin_right; position: absolute; $position'>$img<br><span style='font-size: 12px'>$validatetxt</span><br><span style='font-size: 12px;font-weight: bold'>THE-CODE</span><br><span  style='font-size: 12px'>$validate_url</span></div>";
    }
}
