<?php

namespace Database\Seeders;

use App\Models\SiteOption;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed categories
        SiteOption::updateOrCreate(['key' => 'sms_upon_registration'], ['key' => 'sms_upon_registration', 'type' => 'boolean', 'name' => 'Send SMS upon completion of registration', 'value' => 'yes', 'category' => 'SMS sending settings']);
        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_registration_template'],
            [
                'key' => 'sms_upon_registration_template',
                'type' => 'text',
                'name' => 'Letter template upon completion of registration',
                'value' => "تم تسجيلك بنجاح، فضلا قم باستكمال المعلومات المطلوبة حتى يتم ارسال طلب العضوية\nهيئة الصحفيين السعوديين",
                'category' => 'SMS sending settings'
            ]
        );

        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_completion'],
            [
                'key' => 'sms_upon_completion',
                'type' => 'boolean',
                'name' => 'Send an SMS when completing the information and sending the request',
                'value' => 'yes',
                'category' => 'SMS sending settings'
            ]
        );
        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_completion_template'],
            [
                'key' => 'sms_upon_completion_template',
                'type' => 'text',
                'name' => 'Letter template after completing the information and sending the request',
                'value' => "تم ارسال طلب العضوية، سنقوم بالتحقق من صحة بياناتك\nوسيتم التواصل معك في حال تمت الموافقة\nهيئة الصحفيين السعوديين",
                'category' => 'SMS sending settings'
            ]
        );

        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_approval'],
            [
                'key' => 'sms_upon_approval',
                'type' => 'boolean',
                'name' => 'Send an SMS upon approval of the request',
                'value' => 'yes',
                'category' => 'SMS sending settings'
            ]
        );
        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_approval_template'],
            [
                'key' => 'sms_upon_approval_template',
                'type' => 'text',
                'name' => 'Letter template upon application approval',
                'value' => "تمت الموافقة على العضوية، لتفعيل العضوية قم بالدخول للموقع وسدد المبلغ المطلوب\nهيئة الصحفيين السعوديين",
                'category' => 'SMS sending settings'
            ]
        );

        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_refusal'],
            [
                'key' => 'sms_upon_refusal',
                'type' => 'boolean',
                'name' => 'Send an SMS upon refusal of the request',
                'value' => 'yes',
                'category' => 'SMS sending settings'
            ]
        );
        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_refusal_template'],
            [
                'key' => 'sms_upon_refusal_template',
                'type' => 'text',
                'name' => 'Letter template upon application refusal',
                'value' => "تم رفض عضويتك بهيئة الصحفيين السعوديين\nالسبب: ",
                'category' => 'SMS sending settings'
            ]
        );

        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_payment'],
            [
                'key' => 'sms_upon_payment',
                'type' => 'boolean',
                'name' => 'Send SMS after payment and membership activation',
                'value' => 'yes',
                'category' => 'SMS sending settings'
            ]
        );
        SiteOption::updateOrCreate(
            ['key' => 'sms_upon_payment_template'],
            [
                'key' => 'sms_upon_payment_template',
                'type' => 'text',
                'name' => 'Message template after payment and membership activation',
                'value' => "تمت عملية الدفع وتفعيل العضوية بنجاح\nنأمل أن تحوز خدماتنا على رضاكم\nشكرا لكم\nهيئة الصحفيين السعوديين",
                'category' => 'SMS sending settings'
            ]
        );
    }
}
