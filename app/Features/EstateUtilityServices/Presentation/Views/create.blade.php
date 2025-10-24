@extends('shared::main-layout')
@section('title', 'المرافق | اضافة مرفق')
@section('active-estates', 'active')

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || session()->has('error'))
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

        {{-- estaet information  --}}
        @isset($estate)
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li>عدد الوحدات : {{ $estate->unitCount }} ( سكنى {{ $estate->residentialUnitCount }} ) - ( تجارى
                            {{ $estate->commercialUnitCount }})</li>
                    </ul>
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.utility-services.index', $estate->id) }}" type="button"
                        class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة مرافق العقار</a>
                </div>
            </div>
        @endisset
        {{-- / estaet information  --}}
        <div class="row" style="display:flex; justify-content: center;">
            <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                action="{{ route('estates.utility-services.store', $estate->id) }}">
                <div class="card">
                    <div class="card-header">
                        <strong>اضافة مرفق للعقار</strong>
                    </div>
                    <div class="card-block">
                        @csrf
                        {{-- service type --}}
                        <div class="form-group">
                            <label for="type">نوع المرفق<span class="required">*</span></label>
                            <select id="type" name="type" class="form-control" size="1">
                                @foreach ($utilityServiceTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
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
                                placeholder="الاسم المسجل على الايصال" value="{{ old('owner_name') }}">
                        </div>
                        {{-- / owner name --}}

                        {{-- counter number --}}
                        <div class="form-group">
                            <label for="counter_number">رقم العداد</label>
                            <input name="counter_number" type="text" class="form-control" id="counter_number"
                                placeholder="رقم عداد المرفق" value="{{ old('counter_number') }}">
                        </div>
                        {{-- / counter number --}}

                        {{-- electronic payment number --}}
                        <div class="form-group">
                            <label for="electronic_payment_number">رقم السداد الالكترونى</label>
                            <input name="electronic_payment_number" type="text" class="form-control"
                                id="electronic_payment_number" placeholder="رقم الدفع الالكترونى المسجل على الايصال "
                                value="{{ old('electronic_payment_number') }}">
                        </div>
                        {{-- / electronic payment number --}}

                        {{-- notes --}}
                        <div class="form-group">
                            <label for="notes">ملاحظات</label>
                            <textarea name="notes" class="form-control" id="notes" placeholder="تفاصيل اخرى">{{ old('notes') }}</textarea>
                        </div>
                        {{-- / notes --}}


                        {{-- buttons --}}
                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-plus-circle "></i>
                                اضافة</button>
                            <a href="{{ route('estates.utility-services.index', $estate->id) }}" class="btn btn-md btn-danger"><i
                                    class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                        {{-- / buttons --}}
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
