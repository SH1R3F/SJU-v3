<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => "يجب قبول :attribute.",
    "accepted_if" => "يجب قبول :attribute في حالة :other يساوي :value.",
    "active_url" => "حقل :attribute لا يُمثّل رابطًا صحيحًا.",
    "after" => "يجب على حقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.",
    "after_or_equal" => "حقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.",
    "alpha" => "يجب أن لا يحتوي حقل :attribute سوى على حروف.",
    "alpha_dash" => "يجب أن لا يحتوي حقل :attribute سوى على حروف، أرقام ومطّات.",
    "alpha_num" => "يجب أن يحتوي حقل :attribute على حروفٍ وأرقامٍ فقط.",
    "array" => "يجب أن يكون حقل :attribute ًمصفوفة.",
    "attached" => "حقل :attribute تم إرفاقه بالفعل.",
    "before" => "يجب على حقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.",
    "before_or_equal" => "حقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.",
    "between.array" => "يجب أن يحتوي حقل :attribute على عدد من العناصر بين :min و :max.",
    "between.file" => "يجب أن يكون حجم ملف حقل :attribute بين :min و :max كيلوبايت.",
    "between.numeric" => "يجب أن تكون قيمة حقل :attribute بين :min و :max.",
    "between.string" => "يجب أن يكون عدد حروف نّص حقل :attribute بين :min و :max.",
    "boolean" => "يجب أن تكون قيمة حقل :attribute إما true أو false .",
    "confirmed" => "حقل التأكيد غير مُطابق للحقل :attribute.",
    "current_password" => "كلمة المرور غير صحيحة.",
    "date" => "حقل :attribute ليس تاريخًا صحيحًا.",
    "date_equals" => "يجب أن يكون حقل :attribute مطابقاً للتاريخ :date.",
    "date_format" => "لا يتوافق حقل :attribute مع الشكل :format.",
    "declined" => "يجب رفض :attribute.",
    "declined_if" => "يجب رفض :attribute عندما يكون :other بقيمة :value.",
    "different" => "يجب أن يكون الحقلان :attribute و :other مُختلفين.",
    "digits" => "يجب أن يحتوي حقل :attribute على :digits رقمًا/أرقام.",
    "digits_between" => "يجب أن يحتوي حقل :attribute بين :min و :max رقمًا/أرقام .",
    "dimensions" => "الحقل:attribute يحتوي على أبعاد صورة غير صالحة.",
    "distinct" => "للحقل :attribute قيمة مُكرّرة.",
    "doesnt_end_with" => "الحقل :attribute يجب ألّا يبدأ بأحد القيم التالية: :values.",
    "doesnt_start_with" => "الحقل :attribute يجب ألّا يبدأ بأحد القيم التالية: :values.",
    "email" => "يجب أن يكون حقل :attribute عنوان بريد إلكتروني صحيح البُنية.",
    "ends_with" => "يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values",
    "enum" => "حقل :attribute المختار غير صالح.",
    "exists" => "القيمة المحددة :attribute غير موجودة.",
    "failed" => "بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.",
    "file" => "الحقل :attribute يجب أن يكون ملفا.",
    "filled" => "حقل :attribute إجباري.",
    "gt.array" => "يجب أن يحتوي حقل :attribute على أكثر من :value عناصر/عنصر.",
    "gt.file" => "يجب أن يكون حجم ملف حقل :attribute أكبر من :value كيلوبايت.",
    "gt.numeric" => "يجب أن تكون قيمة حقل :attribute أكبر من :value.",
    "gt.string" => "يجب أن يكون طول نّص حقل :attribute أكثر من :value حروفٍ/حرفًا.",
    "gte.array" => "يجب أن يحتوي حقل :attribute على الأقل على :value عُنصرًا/عناصر.",
    "gte.file" => "يجب أن يكون حجم ملف حقل :attribute على الأقل :value كيلوبايت.",
    "gte.numeric" => "يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :value.",
    "gte.string" => "يجب أن يكون طول نص حقل :attribute على الأقل :value حروفٍ/حرفًا.",
    "image" => "يجب أن يكون حقل :attribute صورةً.",
    "in" => "حقل :attribute غير موجود.",
    "in_array" => "حقل :attribute غير موجود في :other.",
    "integer" => "يجب أن يكون حقل :attribute عددًا صحيحًا.",
    "ip" => "يجب أن يكون حقل :attribute عنوان IP صحيحًا.",
    "ipv4" => "يجب أن يكون حقل :attribute عنوان IPv4 صحيحًا.",
    "ipv6" => "يجب أن يكون حقل :attribute عنوان IPv6 صحيحًا.",
    "json" => "يجب أن يكون حقل :attribute نصًا من نوع JSON.",
    "lt.array" => "يجب أن يحتوي حقل :attribute على أقل من :value عناصر/عنصر.",
    "lt.file" => "يجب أن يكون حجم ملف حقل :attribute أصغر من :value كيلوبايت.",
    "lt.numeric" => "يجب أن تكون قيمة حقل :attribute أصغر من :value.",
    "lt.string" => "يجب أن يكون طول نّص حقل :attribute أقل من :value حروفٍ/حرفًا.",
    "lte.array" => "يجب أن لا يحتوي حقل :attribute على أكثر من :value عناصر/عنصر.",
    "lte.file" => "يجب أن لا يتجاوز حجم ملف حقل :attribute :value كيلوبايت.",
    "lte.numeric" => "يجب أن تكون قيمة حقل :attribute مساوية أو أصغر من :value.",
    "lte.string" => "يجب أن لا يتجاوز طول نّص حقل :attribute :value حروفٍ/حرفًا.",
    "mac_address" => "الحقل :attribute يجب أن يكون عنوان MAC صالحاً.",
    "max.array" => "يجب أن لا يحتوي حقل :attribute على أكثر من :max عناصر/عنصر.",
    "max.file" => "يجب أن لا يتجاوز حجم ملف حقل :attribute :max كيلوبايت.",
    "max.numeric" => "يجب أن تكون قيمة حقل :attribute مساوية أو أصغر من :max.",
    "max.string" => "يجب أن لا يتجاوز طول نّص حقل :attribute :max حروفٍ/حرفًا.",
    "max_digits" => "يجب ألا يحتوي الحقل :attribute على أكثر من :max رقم/أرقام.",
    "mimes" => "يجب أن يكون ملفًا من نوع : :values.",
    "mimetypes" => "يجب أن يكون ملفًا من نوع : :values.",
    "min.array" => "يجب أن يحتوي حقل :attribute على الأقل على :min عُنصرًا/عناصر.",
    "min.file" => "يجب أن يكون حجم ملف حقل :attribute على الأقل :min كيلوبايت.",
    "min.numeric" => "يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :min.",
    "min.string" => "يجب أن يكون طول نص حقل :attribute على الأقل :min حروفٍ/حرفًا.",
    "min_digits" => "يجب أن يحتوي الحقل :attribute على الأقل :min رقم/أرقام.",
    "multiple_of" => "حقل :attribute يجب أن يكون من مضاعفات :value",
    "next" => "التالي &raquo;",
    "not_in" => "عنصر الحقل :attribute غير صحيح.",
    "not_regex" => "صيغة حقل :attribute غير صحيحة.",
    "numeric" => "يجب على حقل :attribute أن يكون رقمًا.",
    "password" => "كلمة المرور غير صحيحة.",
    "password.letters" => "يجب أن يحتوي حقل :attribute على حرف واحد على الأقل.",
    "password.mixed" => "يجب أن يحتوي حقل :attribute على حرف كبير وحرف صغير على الأقل.",
    "password.numbers" => "يجب أن يحتوي حقل :attribute على رقمٍ واحدٍ على الأقل.",
    "password.symbols" => "يجب أن يحتوي حقل :attribute على رمزٍ واحدٍ على الأقل.",
    "password.uncompromised" => "حقل :attribute ظهر في بيانات مُسربة. الرجاء اختيار :attribute مختلف.",
    "present" => "يجب تقديم حقل :attribute.",
    "previous" => "&laquo; السابق",
    "prohibited" => "حقل :attribute محظور.",
    "prohibited_if" => "حقل :attribute محظور إذا كان :other هو :value.",
    "prohibited_unless" => "حقل :attribute محظور ما لم يكن :other ضمن :values.",
    "prohibits" => "الحقل :attribute يحظر تواجد الحقل :other.",
    "regex" => "صيغة حقل :attribute .غير صحيحة.",
    "relatable" => "حقل :attribute قد لا يكون مرتبطا بالمصدر المحدد.",
    "required" => "حقل :attribute مطلوب.",
    "required_array_keys" => "الحقل :attribute يجب أن يحتوي على مدخلات لـ: :values.",
    "required_if" => "حقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.",
    "required_unless" => "حقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.",
    "required_with" => "حقل :attribute مطلوب إذا توفّر :values.",
    "required_with_all" => "حقل :attribute مطلوب إذا توفّر :values.",
    "required_without" => "حقل :attribute مطلوب إذا لم يتوفّر :values.",
    "required_without_all" => "حقل :attribute مطلوب إذا لم يتوفّر :values.",
    "reset" => "تمت إعادة تعيين كلمة المرور!",
    "same" => "يجب أن يتطابق حقل :attribute مع :other.",
    "sent" => "تم إرسال تفاصيل استعادة كلمة المرور الخاصة بك إلى بريدك الإلكتروني!",
    "size.array" => "يجب أن يحتوي حقل :attribute على :size عنصرٍ/عناصر بالضبط.",
    "size.file" => "يجب أن يكون حجم ملف حقل :attribute :size كيلوبايت.",
    "size.numeric" => "يجب أن تكون قيمة حقل :attribute مساوية لـ :size.",
    "size.string" => "يجب أن يحتوي نص حقل :attribute على :size حروفٍ/حرفًا بالضبط.",
    "starts_with" => "يجب أن يبدأ حقل :attribute بأحد القيم التالية: :values",
    "string" => "يجب أن يكون حقل :attribute نصًا.",
    "throttle" => "عدد كبير جدا من محاولات الدخول. يرجى المحاولة مرة أخرى بعد :seconds ثانية.",
    "throttled" => "الرجاء الانتظار قبل إعادة المحاولة.",
    "timezone" => "يجب أن يكون حقل :attribute نطاقًا زمنيًا صحيحًا.",
    "token" => "رمز استعادة كلمة المرور الذي أدخلته غير صحيح.",
    "unique" => "قيمة حقل :attribute مُستخدمة من قبل.",
    "uploaded" => "فشل في تحميل الـ :attribute.",
    "url" => "صيغة رابط حقل :attribute غير صحيحة.",
    "user" => "لم يتم العثور على أيّ حسابٍ بهذا العنوان الإلكتروني.",
    "uuid" => "حقل :attribute يجب أن يكون بصيغة UUID سليمة.",
    "successful_update" => "تم التعديل بنجاح",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'recipients' => [
            "required_if" => "حقل :attribute مطلوب في حال ما إذا كان :other هي تحديد.",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'permissions' => 'الصلاحيات',
        'permissions.*' => 'الصلاحية',
        'fname' => 'الاسم الاول',
        'lname' => 'الاسم الأخير',
        'username' => 'اسم المستخدم',
        'mobile' => 'رقم الجوال',
        'role_id' => 'الدور',
        'branch_id' => 'الفرع',
        'password' => 'كلمة المرور',
        'message' => 'الرسالة',
        'via' => 'طريقة الإرسال',
        'recipients' => 'المستقبلين',
        'to_type' => 'طريقة الإرسال',
        'select' => 'تحديد'
    ],

];
