@extends('shared::main-layout')
@section('title', 'الوحدات | تسجيل عقد ايجار')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.create', $estate->id, $unit->id) }}
    @endisset
@endsection
@section('content')
    <div class="container-fluid">
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
        @endisset
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

        {{-- unit information --}}
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

        @isset($renters)
            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.contracts.store', ['estate' => $estate->id, 'unit' => $unit->id]) }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <strong>تسجيل عقد ايجار<strong>
                        </div>
                        <div class="card-block">

                            {{-- renters --}}
                            <div class="form-group">
                                <label for="renter_id">اسم المستأجر<span class="required">*</span></label>
                                <select id="renter_id" name="renter_id" class="form-control" size="1">
                                    @foreach ($renters as $renter)
                                        <option value="{{ $renter->id }}">{{ $renter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / renters --}}

                            {{-- contract type --}}
                            <div class="form-group">
                                <label for="contract_type">نوع التعاقد<span class="required">*</span></label>
                                <select id="contract_type" name="contract_type" class="form-control" size="1">
                                    @foreach ($unitContractTypes as $value=>$label)
                                        <option value="{{ $value }}">{{ $label}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- / contract type --}}

                            {{-- rent value  --}}
                            <div class="form-group">
                                <label for="rent_value">قيمة الايجار<span class="required">*</span></label>
                                <input name="rent_value" type="text" class="form-control" id="rent_value"
                                    placeholder="قيمة الايجار وقت التعاقد" value="{{ old('rent_value') }}">
                            </div>
                            {{-- / rent value  --}}

                            {{-- annual rent increasment --}}
                            <div class="form-group">
                                <label for="annual_rent_increasement">الزيادة السنوية<span class="required">*</span></label>
                                <input name="annual_rent_increasement" type="text" class="form-control"
                                    id="annual_rent_increasement" placeholder="نسبة مئوية - 0 الى 100"
                                    value="{{ old('annual_rent_increasement') }}">
                            </div>
                            {{-- annual rent increasment --}}

                            {{-- insurance  --}}
                            <div class="form-group">
                                <label for="insurance_value">قيمة التأمين<span class="required">*</span></label>
                                <input name="insurance_value" type="text" class="form-control" id="insurance_value"
                                    placeholder="قيمة التأمين" value="{{ old('insurance_value') }}">
                            </div>
                            {{-- insurance  --}}

                            {{-- start date --}}
                            <div class="form-group">
                                <label for="start_date">تاريخ التعاقد<span class="required">*</span></label>
                                <input name="start_date" type="date" class="form-control" id="start_date"
                                    value="{{ old('start_date', $currentDateValue) }}">
                            </div>
                            {{-- start date --}}

                            {{-- end date --}}
                            <div class="form-group">
                                <label for="end_date">تاريخ انتهاء التعاقد<span class="required">*</span></label>
                                <input name="end_date" type="date" class="form-control" id="end_date"
                                    value="{{ old('end_date', $currentDateValue) }}">
                            </div>
                            {{-- end date --}}

                            {{-- water_invoice_percentage --}}
                            <div class="form-group">
                                <label for="water_invoice_percentage">نسبة تحصيل فاتورة مياة العقار المشتركة<span
                                        class="required">*</span></label>
                                <input name="water_invoice_percentage" type="text" class="form-control"
                                    id="water_invoice_percentage"
                                    placeholder="مثال: 1 يعادل شقة - 1.5 يعادل شقة ونصف ... الخ"
                                    value="{{ old('water_invoice_percentage') }}">
                            </div>
                            {{-- / water_invoice_percentage --}}

                            {{-- electricity_invoice_percentage --}}
                            <div class="form-group" hidden >
                                <label for="electricity_invoice_percentage">نسبة تحصيل فاتورة كهرباء العقار
                                    المشتركة<span class="required">*</span></label>
                                <input name="electricity_invoice_percentage" type="text" class="form-control"
                                    id="electricity_invoice_percentage"
                                    placeholder="مثال: 1 يعادل شقة - 1.5 يعادل شقة ونصف ... الخ"
                                    value="{{ old('electricity_invoice_percentage' , 1) }}">
                            </div>
                            {{-- electricity_invoice_percentage --}}

                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle "></i>
                                    اضافة</button>
                                <a href="{{ route('estates.units.contracts.index', ['estate'=>$estate->id, 'unit'=>$unit->id]) }}"
                                    class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        @endif

    @endsection
