@extends('shared::main-layout')
@section('title', 'سجل الايجارات | سداد ايجار ')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unitContract)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.rent-invoices.create', $estate->id, $unit->id, $unitContract->id) }}
    @endisset
@endsection
@section('content')

    {{-- Errors --}}
    @if ($errors->any() || isset($error) || session()->has('error'))
        <div class="row" style="display:flex; justify-content:center;">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="card card-inverse card-danger ">
                    <div class="card-block">
                        <ul>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @elseif (isset($error))
                                <li>{{ $error }}</li>
                            @elseif (session('error'))
                                <li>{{ session('error') }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- / Errors --}}

    {{-- success message --}}
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
    {{-- / success message --}}

    <div class="container-fluid">
        @if (isset($unitContract))
            <div class="card">
                <div class="card-header">
                    بيانات التعاقد
                </div>
                <div class="card-block">
                    <ul>
                        <li> حالة العقد :
                            @if ($unitContract->isInFuture())
                                <span style="font-weight:bold;color:blue">لم يبدأ بعد</span>
                            @elseif ($unitContract->isExpired())
                                <span style="font-weight:bold;color:red">منتهى</span>
                            @else
                                <span style="font-weight:bold;color:green">سارى </span>
                                <div style="display:inline-block;margin-right:20px" class="bars">
                                    <progress class="progress progress-xs progress-primary m-a-0"
                                        value="{{ $unitContract->getMonthsPassedPercentage() }}" max="100"></progress>
                                </div>
                            @endif
                            <hr>

                        </li>
                        <li> المستأجر :
                            @if ($unitContract->renter)
                                <a style="color:black" href="{{ route('renters.show', $renter->id) }}"
                                    target="_blank">{{ $renter->name }}</a>
                            @else
                                <span style="color:red">(تم حذفة من النظام)</span>
                            @endif
                        </li>
                        <li>مدة التعاقد :( {{ $unitContract->startDate->toDateString() }} ) الى (
                            {{ $unitContract->endDate->toDateString() }} ) ({{ $unitContract->type->toLabel() }})</li>
                        <li>قيمة الايجار عند التعاقد : {{ $unitContract->rentValue }} +
                            ({{ $unitContract->annualRentIncreasement }}% سنوياً)</li>
                        <li>قيمة الايجار الحالية :
                            {{ $unitContract->isExpired() ? '----' : $unitContract->getCurrentRentValue() }}
                        </li>
                    </ul>
                    <hr>
                    <ul>
                        <li>تنتمى للعقار : {{ $estate->name }}</li>
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                        <hr>
                        <li> رقم الوحدة : {{ $unit->number }} ---
                            الطابق : {{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }} ---
                            نوع الوحدة : {{ $unit->type->toLabel() }}
                        </li>
                    </ul>
                </div>
            </div> {{-- / card --}}

            {{-- crete rent invoice form --}}
            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.contracts.rent-invoices.store', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <strong>تسجيل سداد ايجار</strong>
                        </div>
                        <div class="card-block">

                            {{-- amount --}}
                            <div class="form-group">
                                <label for="amount">المبلغ المسدد<span class="required">*</span></label>
                                <input name="amount" type="text" class="form-control" id="amount"
                                    placeholder="قيمة الايجار او جزء منها " value="{{ old('amount') }}">
                            </div>
                            {{-- for month --}}
                            <div class="form-group">
                                <label for="for_month">شهر الاستحقاق<span class="required">*</span></label>
                                <select name="for_month" type="text" class="form-control" id="for_month">
                                    @foreach ($months as $month)
                                        <option value="{{ $month->value }}"
                                            {{ old('for_month', $currentMonth->value) == $month->value ? 'selected' : null }}>
                                            {{ $month->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / for month --}}

                            {{-- for year --}}
                            <div class="form-group">
                                <label for="for_year">العام<span class="required">*</span></label>
                                <input name="for_year" type="number" class="form-control" id="for_year"
                                    placeholder="العام" value="{{ old('for_year' , $currentYear) }}">
                            </div>
                            {{-- / for year --}}

                            {{--  notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control" id="notes" placeholder="اى ملاحظات او تفاصيل اخرى عن المالك">{{ old('notes') }}</textarea>
                            </div>
                            {{--  / notes --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    اضافة</button>
                                <a href="{{ url()->previous() }}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
            {{-- / crete rent invoice form --}}
        @endif
    </div>
@endsection
