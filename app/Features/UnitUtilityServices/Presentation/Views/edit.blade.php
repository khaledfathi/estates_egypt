@extends('shared::main-layout')
@section('title', 'الوحدات | اضافة مرفق')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.utility-services.edit', $estate->id , $unit->id, $unitUtilityService->id) }}
    @endisset
@endsection
@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || session()->has('error') ||isset($error))
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
                                @elseif(isset($error))
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

        {{-- unit information  --}}
        @if (isset($estate) && isset($unit))
            <div class="card">
                <div class="card-header">
                    بيانات الوحدة
                </div>
                <div class="card-block">
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
            </div>
        @endif
        {{-- / unit information --}}

        @isset($unitUtilityService)
            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.utility-services.update', ['estate' => $estate->id, 'unit' => $unit->id, 'utility_service' => $unitUtilityService->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث بيانات مرفق الوحدة</strong>
                        </div>
                        <div class="card-block">
                            {{-- service type --}}
                            <div class="form-group">
                                <label for="type">نوع المرفق<span class="required">*</span></label>
                                <select id="type" name="type" class="form-control" size="1">
                                    @foreach ($utilityServiceTypes as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('type', $unitUtilityService->type->value) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- service type --}}

                            {{-- owner name --}}
                            <div class="form-group">
                                <label for="owner_name">اسم مالك العداد<span class="required">*</span></label>
                                <input name="owner_name" type="text" class="form-control" id="owner_name"
                                    placeholder="الاسم المسجل على الايصال"
                                    value="{{ old('owner_name', $unitUtilityService->ownerName) }}">
                            </div>
                            {{-- / owner name --}}

                            {{-- counter number --}}
                            <div class="form-group">
                                <label for="counter_number">رقم العداد</label>
                                <input name="counter_number" type="text" class="form-control" id="counter_number"
                                    placeholder="رقم عداد المرفق"
                                    value="{{ old('counter_number', $unitUtilityService->counterNumber) }}">
                            </div>
                            {{-- / counter number --}}

                            {{-- electronic payment number --}}
                            <div class="form-group">
                                <label for="electronic_payment_number">رقم الدفع الالكترونى</label>
                                <input name="electronic_payment_number" type="text" class="form-control"
                                    id="electronic_payment_number" placeholder="رقم الدفع الالكترونى المسجل على الايصال "
                                    value="{{ old('electronic_payment_number', $unitUtilityService->electronicPaymentNumber) }}">
                            </div>
                            {{-- / electronic payment number --}}

                            {{-- notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control" id="notes" placeholder="تفاصيل اخرى">{{ old('notes', $unitUtilityService->notes) }}</textarea>
                            </div>
                            {{-- / notes --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ route('estates.units.utility-services.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'utility_service' => $unitUtilityService->id]) }}"
                                    class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{$previousURL}}"
                                    class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
        @endisset
</div>
@endsection
