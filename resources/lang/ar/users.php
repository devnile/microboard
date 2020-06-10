<?php

return [
    'resource' => 'المستخدمين',

    'fields' => [
        'id' => '#',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور'
    ],

    'create' => [
        'title' => 'أضف مستخدم جديد'
    ],

    'view' => [
        'action-button' => 'مشاهدة'
    ],

    'edit' => [
        'action-button' => 'تعديل'
    ],

    'delete' => [
        'action-button' => 'حـذف نهائي',
        'title' => 'هل أنت متأكد من القيام بذلك؟',
        'text' => 'ستفقد معلومات السجل وعلاقاته أيضاً بشكل نهائي!',
        'confirm' => 'نعم، قم بالحذف',
        'cancel' => 'لا، إلغِ الأمر'
    ]
];
