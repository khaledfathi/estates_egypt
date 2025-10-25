<?php
declare (strict_types= 1);
namespace App\Shared\Presentation\Constants;

final class Messages {
    public const INTERNAL_SERVER_ERROR =   'خطأ فى الخادم - برجاء التواصل مع الدعم الفنى';
    public const FILE_NOT_FOUND=   'خطأ : محاول الوصول لملف غير موجود ';
    public const DATA_NOT_FOUND = 'خطأ : محاولة الوصول الى بيانات غير مسجلة بالنظام';
    public const STORE_SUCCESS = 'تم الحفظ بنجاح';
    public const UPDATE_SUCCESS = 'تم التحديث بنجاح';
    public const DESTROY_SUCCESS= 'تم الحذف بنجاح';
    public const CAN_NOT_DELETE_DEFAULT_GROUP=   'لا يمكن حذف المجموعة الافتراضية';
}