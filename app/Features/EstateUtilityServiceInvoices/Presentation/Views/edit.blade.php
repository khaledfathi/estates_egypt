@extends('shared::main-layout')
@section('title', 'مرافق العقار | تحديث بيانات فاتورة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($estateUtilityService)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.utility-services.invoices.edit', $estate->id, $estateUtilityService->id , $invoice->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/unit-utility-services-invoices/edit.css')
@endsection
@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || session()->has('error') || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif (session('error'))
                                    <li>{{ session('error') }}</li>
                                @elseif (isset($error))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        {{-- / Errors --}}

        {{-- success message  --}}
        @if (session('success'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-success">
                        <div class="card-block">
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / success message  --}}


        @isset($estateUtilityService)

            {{-- estaet and utilityService information  --}}
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                        <hr>
                        <li>نوع المرفق : {{ $estateUtilityService->type->toLabel() }}</li>
                        <li>اسم المتعاقد : {{ $estateUtilityService->ownerName }} </li>
                        <li>رقم العداد : {{ $estateUtilityService->counterNumber ?? '----' }}</li>
                        <li>رقم السداد الالكترونى : {{ $estateUtilityService->electronicPaymentNumber }}</li>
                    </ul>
                </div>
            </div>
            {{-- / estaet and utilityService information  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.utility-services.invoices.update', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id, 'invoice'=>$invoice->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <strong>تسجيل فاتورة مرفق</strong>
                        </div>
                        <div class="card-block">
                            {{-- type --}}
                            <label for=" "> نوع المرفق : {{ $estateUtilityService->type->toLabel() }}</label>
                            <hr>
                            {{-- type --}}

                            {{-- amount --}}
                            <div class="form-group">
                                <label for="amount">قيمة الفاتورة<span class="required">*</span></label>
                                <input name="amount" type="text" class="form-control" id="amount"
                                    placeholder="المبلغ المطلوب سدادة للمرفق"
                                    value="{{ old('amount', $invoice->amount) }}">
                            </div>
                            {{-- / amount --}}

                            {{-- for month --}}
                            <div class="form-group">
                                <label for="for_month">شهر الاستحقاق<span class="required">*</span></label>
                                <select name="for_month" type="text" class="form-control" id="for_month">
                                    @foreach ($months as $month)
                                        <option value="{{ $month->value }}"
                                            {{ old('for_month', $invoice->forMonth) == $month->value ? 'selected' : null }}>
                                            {{ $month->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / for month --}}

                            {{-- for year --}}
                            <div class="form-group">
                                <label for="for_year">العام<span class="required">*</span></label>
                                <input name="for_year" type="number" class="form-control" id="for_year"
                                    placeholder="العام" value="{{ old('for_year', $invoice->forYear) }}">
                            </div>
                            {{-- / for year --}}

                            {{-- file --}}
                            <div>
                            </div>
                            <div class="form-group">
                                @if ($invoice->file)
                                    <a href="{{ route('estates.utility-services.invoices.view-file', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id, 'invoice' => $invoice->id, 'file' => $invoice->file]) }}"
                                        style="text-decoration:none" target="_blank" alt="document file">
                                        <i class="action-icon action-icon--file fa fa-file-image-o fa-lg"></i>
                                    </a>
                                @endif
                                <label for="description">صورة ايصال السداد</label>
                                <input class="form-control" name="file" type="file" id="file">
                            </div>
                            {{-- / file --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    تحديث</button>
                                <a href="{{ route('estates.utility-services.invoices.edit', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id, 'invoice' => $invoice->id]) }}" class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{ route('estates.utility-services.show', ['estate' => $estate->id, 'utility_service' => $estateUtilityService->id]) }}"
                                    class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
