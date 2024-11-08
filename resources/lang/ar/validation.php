<?php

return [

    'accepted'             => 'يجب قبول :attribute.',
    'accepted_if'          => 'يجب قبول :attribute عندما يكون :other :value.',
    'active_url'           => ':attribute ليس رابطًا صحيحًا.',
    'after'                => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal'       => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
    'alpha'                => 'قد يحتوي :attribute على أحرف فقط.',
    'alpha_dash'           => 'قد يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'قد يحتوي :attribute على أحرف وأرقام فقط.',
    'array'                => 'يجب أن يكون :attribute مصفوفة.',
    'before'               => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal'      => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute بين :min و :max حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute بين :min و :max عنصرًا.',
    ],
    'boolean'              => 'يجب أن يكون حقل :attribute صحيحًا أو خطأ.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'current_password'     => 'كلمة المرور غير صحيحة.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute تاريخًا يساوي :date.',
    'date_format'          => 'لا يتطابق :attribute مع الشكل :format.',
    'declined'             => 'يجب رفض :attribute.',
    'declined_if'          => 'يجب رفض :attribute عندما يكون :other :value.',
    'different'            => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يكون :attribute :digits أرقام.',
    'digits_between'       => 'يجب أن يكون :attribute بين :min و :max أرقام.',
    'dimensions'           => ':attribute له أبعاد صورة غير صالحة.',
    'distinct'             => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'exists'               => ':attribute المحدد غير صالح.',
    'file'                 => 'يجب أن يكون :attribute ملفًا.',
    'filled'               => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من أو يساوي :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على :value عنصرًا أو أكثر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورة.',
    'in'                   => ':attribute المحدد غير صالح.',
    'in_array'             => 'حقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صالحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
    'json'                 => 'يجب أن يكون :attribute نص JSON صالحًا.',
    'lt'                   => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file'    => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عنصرًا.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أقل من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من أو يساوي :value حرفًا.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'max'                  => [
        'numeric' => 'قد لا يكون :attribute أكبر من :max.',
        'file'    => 'قد لا يكون :attribute أكبر من :max كيلوبايت.',
        'string'  => 'قد لا يكون :attribute أكبر من :max حرفًا.',
        'array'   => 'قد لا يحتوي :attribute على أكثر من :max عنصرًا.',
    ],
    'mimes'                => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
    'mimetypes'            => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
    'min'                  => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute على الأقل :min حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل :min عنصرًا.',
    ],
    'multiple_of'          => 'يجب أن يكون :attribute مضاعفًا لـ :value.',
    'not_in'               => ':attribute المحدد غير صالح.',
    'not_regex'            => 'تنسيق :attribute غير صالح.',
    'numeric'              => 'يجب أن يكون :attribute رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب أن يكون حقل :attribute حاضرًا.',
    'prohibited'           => 'حقل :attribute محظور.',
    'prohibited_if'        => 'حقل :attribute محظور عندما يكون :other :value.',
    'prohibited_unless'    => 'حقل :attribute محظور ما لم يكن :other في :values.',
    'prohibits'            => 'حقل :attribute يحظر :other من التواجد.',
    'regex'                => 'تنسيق :attribute غير صالح.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_array_keys'  => 'يجب أن يحتوي حقل :attribute على إدخالات لـ: :values.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other :value.',
    'required_unless'      => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يكون :values حاضرًا.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون :values حاضرة.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا تكون :values حاضرة.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values حاضرة.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن يكون :attribute :size.',
        'file'    => 'يجب أن يكون :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute :size حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرًا.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute منطقة زمنية صالحة.',
    'unique'               => 'تم أخذ :attribute بالفعل.',
    'uploaded'             => 'فشل تحميل :attribute.',
    'url'                  => 'تنسيق :attribute غير صالح.',
    'uuid'                 => 'يجب أن يكون :attribute UUID صالحًا.',

    'custom' => [
        'phone' => [
            'unique' => 'تم أخذ رقم الهاتف بالفعل.',
            'exists' => 'رقم الهاتف المدخل  مسجل لدينا.',
        ],
        'email' => [
            'exists' => 'البريد الإلكتروني المدخل غير مسجل لدينا.',
            'unique' => 'البريد الإلكتروني مسجل لدينا.',
            'required' => 'البريد الإلكتروني مطلوب.',
        ],
        'user_name' => [
            'unique' => 'اسم المستخدم مسجل لدينا.',
            'required' => 'اسم المستخدم مطلوب.',
        ],
        'password' => [
            'confirmed' => 'كلمة المرور غير متطابقة.',
            'required' => 'كلمة المرور مطلوبة.',
        ],
        'verification_code' => [    
            'digits' => 'رمز التحقق يجب ان يكون ارقام .',
        ],
        'address' => [
            'string' => 'العنوان يجب ان يكون حروف و ارقام فقط.',
        ],
        'gender' => [
            'string' => 'الجنس يجب ان يكون حروف فقط.',
        ],
        'logo' => [
            'image' => 'الشعار يجب ان يكون صورة.',
        ],
        'type' => [
            'string' => 'نوع المدرسة يجب ان يكون حروف فقط.',
            'in' => 'يجب ان يكون نوع المستخدم مستهلك او تاجر'
        ],
    'product_id' => [
        'required' => 'معرف المنتج مطلوب.',
        'integer' => 'يجب أن يكون معرف المنتج عددًا صحيحًا.',
        'exists' => ' المنتج غير موجود.',
    ],
        

    ],

    'validation_errors' => 'Validation errors',

    'attributes' => [
        'attributes' => [
            'type' => 'نوع المستخدم',
            'user_name' => 'اسم المستخدم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'confirm_password' => 'تأكيد كلمة المرور',
            'current_password'    => 'كلمة المرور الحالية',
            'new_password'        => 'كلمة المرور الجديدة',
            'email'               => 'البريد الإلكتروني',
            'password'            => 'كلمة المرور',
            'user_name'          => 'اسم المستخدم',
            'gender'              => 'الجنس',
            'address'             => 'العنوان',
            'phone'               => 'رقم الهاتف',
            'verification_code'   => 'رمز التحقق',
            'code'                => 'الرمز',
            'user_id'             => ' المستخدم',
            'publishing_house_id' => ' دار النشر',
            'established_year'    => 'سنة التأسيس',
            'student_count'       => 'عدد الطلاب',
            'teacher_count'       => 'عدد المعلمين',
            'logo'                => 'الشعار',
            'type'                => 'نوع المدرسة',
        ],

    ],


];
