<?php

return [
    'resource' => 'الرتب والصلاحيات',

    'fields' => [
        'id' => '#',
		'name' => 'الاسم المميز',
		'display_name' => 'اسم العرض',
        'permissionsCount' => 'عدد الصلاحيات',
        'users' => 'المستخدمين في هذه الرتبة',
        'permissions' => [
            'viewAny' => 'الصفحة الرئيسية',
            'view' => 'صفحة السجل',
            'create' => 'اضافة سجل',
            'update' => 'تعديل السجلات',
            'delete' => 'حذف السجلات',
        ],
        'created_at' => 'إنشء في',
        'updated_at' => 'أخر تعديل في'
    ],

    'create' => [
        'title' => 'إضافة جديد',
        'cancel' => 'إلفاء',
        'save' => 'إضافة جديد'
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
        'action-button' => 'حـذف نهائي',
        'title' => 'هل أنت متأكد من القيام بذلك؟',
        'text' => 'ستفقد معلومات السجل وعلاقاته أيضاً بشكل نهائي!',
        'confirm' => 'نعم، قم بالحذف',
        'cancel' => 'لا، إلغِ الأمر'
    ]
];
