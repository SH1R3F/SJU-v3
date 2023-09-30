<?php

return [
    'mode'                     => '',
    'format'                   => 'A4',
    'default_font_size'        => '12',
    'default_font'             => 'sans-serif',
    'margin_left'              => 0,
    'margin_right'             => 0,
    'margin_top'               => 0,
    'margin_bottom'            => 0,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'SJU',
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'auto_language_detection'  => false,
    'temp_dir'                 => storage_path('app'),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
    'custom_font_dir'  => base_path('resources/fonts/'),
    'custom_font_data' => [
        /* Arabic fonts */
        "xbriyaz" => [
            'R' => "XB Riyaz.ttf",
            'B' => "XB RiyazBd.ttf",
            'I' => "XB RiyazIt.ttf",
            'BI' => "XB RiyazBdIt.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "lateef" => [/* Sindhi, Pashto and Urdu */
            'R' => "LateefRegOT.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "droidkufi" => [/* Sindhi, Pashto and Urdu */
            'R' => "DroidKufi-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "almarai" => [
            'R' => "Almarai-Regular.ttf",
            'B' => "Almarai-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "cairo" => [
            'R' => "Cairo-Regular.ttf",
            'B' => "Cairo-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "pointart" => [
            'R' => "pointart-sans-serif-Bold.ttf",
            'B' => "pointart-sans-serif-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "khayma" => [
            'R' => "KhaymaDEMO-Regular.ttf",
            'useOTL' => 0xFF,
        ],
        "diwani" => [
            'R' => "alfont_com_AlFont_com_Diwani-Letter.ttf",
            'B' => "alfont_com_AlFont_com_Diwani-Letter.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "lemonada" => [
            'R' => "Lemonada-Regular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "kufam" => [
            'R' => "Kufam-Regular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "marhey" => [
            'R' => "Marhey-Regular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "granada" => [
            'R' => "Granada-Regular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "29ltbukraregular" => [
            'R' => "29ltbukraregular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "rakkas" => [
            'R' => "Rakkas-Regular.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "gess" => [
            'R' => "GE_SS_TWO_MEDIUM.ttf",
            'B' => "GE_SS_TWO_MEDIUM.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "tajawal" => [
            'R' => "Tajawal-Regular.ttf",
            'B' => "Tajawal-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "amiri" => [
            'R' => "Amiri-Regular.ttf",
            'B' => "Amiri-Bold.ttf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        "kfgqpcuthmantahanaskh" => [/* KFGQPC Uthman Taha Naskh - Koranic */
            'R' => "Uthman.otf",
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        /* CJK fonts */
        "sun-exta" => [
            'R' => "Sun-ExtA.ttf",
            'sip-ext' => 'sun-extb', /* SIP=Plane2 Unicode (extension B) */
        ],
        "sun-extb" => [
            'R' => "Sun-ExtB.ttf",
        ],
        "unbatang" => [/* Korean */
            'R' => "UnBatang_0613.ttf",
        ],
    ],
    'unAGlyphs' => true,
    // 'default_font' => 'amiri',
];
