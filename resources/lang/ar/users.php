<?php

return [
    'resource' => 'المستخدمين',

    'fields' => [
        'id' => '#',
        'avatar' => 'الصورة الشخصية',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور'
    ],

    'create' => [
        'title' => 'أضف مستخدم جديد',
        'cancel' => 'إلفاء',
        'save' => 'إنشاء المستخدم'
    ],

    'view' => [
        'action-button' => 'مشاهدة',
        'title' => 'مشاهدة صفحة :name'
    ],

    'edit' => [
        'action-button' => 'تعديل',
        'title' => 'تعديل',
        'cancel' => 'إلفاء',
        'save' => 'حفظ التغييرات'
    ],

    'delete' => [
        'action-button' => 'حـذف نهائي',
        'title' => 'هل أنت متأكد من القيام بذلك؟',
        'text' => 'ستفقد معلومات السجل وعلاقاته أيضاً بشكل نهائي!',
        'confirm' => 'نعم، قم بالحذف',
        'cancel' => 'لا، إلغِ الأمر'
    ]
];
