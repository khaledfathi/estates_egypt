@extends('shared::main-layout')
@section('title', 'الحسابات')
@section('active-accounting', 'active')

@section('content')

    <div class="container-fluid" style="display:flex;gap:20px;justify-content:center;flex-wrap: wrap">
        <a href="{{ route('transactions.index') }}" class="btn btn-primary btn-lg">الخزينة</a>
        <a href="{{ route('maintenance-expenses.index') }}" class="btn btn-primary btn-lg">مصروفات صيانة</a>
        <a href="" class="btn btn-primary btn-lg">تسديد ايجارات</a>
        <a href="" class="btn btn-primary btn-lg">تسديد فواتير مرافق</a>
    </div>
    {{-- -------------------------------------------------- --}}
    <hr>
    <p>الايجارات غير المسددة</p>
    <p>الشهر الحالى 12344</p>
    <p>السنة الحالية 43255</p>
    <p>كل الوقت 43255</p>
    <hr>
    <p>فواتير مرافق غير مسددة</p>
    <p>الشهر الحالى : 432423</p>
    <p>السنة الحالية : 43245</p>
    <p>كل الوقت : 4325</p>
    <hr>
    <p>رصيد الخزينة</p>
    <p>الشهر الحالى : 435532 (دائن 4324 - مدين 4324)</p>
    <p>السنة الحالى : 43884 (دائن 3394 - مدين 434)</p>
    <p>كل الوقت : 4588 (دائن 84757 - مدين 4553)</p>
    <hr>
@endsection
