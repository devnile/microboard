<?php

return [
    'resource' => 'إعدادات النظام',

    'fields' => [
        'id' => '#',
        'title' => 'عنوان الحقل',
        'group' => 'القسم',
        'key' => 'الاسم المميز',
        'value' => 'الحقل',
        'more' => 'المزيد من الخيارات',
        'types' => [
            'argonInput|text' => 'حقل نصي',
            'argonTextarea' => 'حقل نصي متعدد الاسطر',
            'trix' => 'حقل نصي متقدم',
            'argonInput|email' => 'بريد إلكتروني',
            'argonInput|tel' => 'رقم هاتف',
            'argonInput|number' => 'قيمة عددية',
            'argonSelect' => 'قائمة منسدلة',
            'avatar' => 'صورة',
            'files' => 'صور متعددة'
        ],
        'created_at' => 'إنشء في',
        'updated_at' => 'أخر تعديل في'
    ],

    'create' => [
        'title' => 'إضافة جديد',
        'cancel' => 'إلفاء',
        'save' => 'إضافة'
    ],

    'view' => [
        'action-button' => 'مشاهدة',
        'title' => 'مشاهدة'
    ],

    'edit' => [
        'action-button' => 'تعديل',
        'title' => 'تعديل',
        'cancel' => 'إلفاء',
        'save' => 'حفظ التغييرات'
    ],

    'delete' => [
        'action-button' => 'حذف الحقل',
        'title' => 'هل أنت متأكد من القيام بذلك؟',
        'text' => 'ستفقد معلومات السجل وعلاقاته أيضاً بشكل نهائي!',
        'confirm' => 'نعم، قم بالحذف',
        'cancel' => 'لا، إلغِ الأمر'
    ],

    'messages' => [
        'created' => 'تمت الاضافة بنجاح',
        'updated' => 'تم تعديل الإعدادات بنجاح'
    ]
];
