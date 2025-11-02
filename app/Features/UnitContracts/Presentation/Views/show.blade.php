@extends('shared::main-layout')
@section('title', 'الوحدات | عرض عقد ايجار')
@section('active-estates', 'active')

@section('styles')
    @vite('resources/css/features/unit-contracts/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/unit-contracts/show.ts')
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
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.units.index', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة وحدات العقار</a>
                    <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-home fa-lg"></i> &nbsp; الذهاب للوحدة</a>
                    <a href="{{ route('estates.units.contracts.index', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        type="button" class="btn btn-primary">
                        <i class="icon-layers icons fa-lg"></i> &nbsp; الذهاب لقائمة التعاقدات</a>
                </div>
            </div>
        @endif
        {{-- / unit information --}}

        @isset($unitContract)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات عقد الايجار</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.units.contracts.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates.units.contracts.destroy', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i
                                        class="delete-contract-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input class="delete-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>حالة العقد :

                                    @if ($unitContract->isInFuture())
                                        <span style="font-weight:bold;color:blue">لم يبدأ بعد</span>
                                    @elseif ($unitContract->isExpired())
                                        <span style="font-weight:bold;color:red">منتهى</span>
                                    @else
                                        <span style="font-weight:bold;color:green">سارى </span>
                                        <div style="display:inline-block;margin-right:20px" class="bars">
                                            <progress class="progress progress-xs progress-primary m-a-0"
                                                value="{{ $unitContract->getMonthsPassedPercentage() }}"
                                                max="100"></progress>
                                        </div>
                                    @endif
                                    <hr>
                                <li>المستأجر :
                                    @if ($unitContract->renter)
                                        <a style="color:black" href="{{ route('renters.show', $renter->id) }}"
                                            target="_blank">{{ $renter->name }}</a>
                                        <ul>
                                            <li>نوع الهوية : {{ $renter->identityType->toLabel() }}</li>
                                            <li>رقم الهوية: {{ $renter->identityNumber }}</li>
                                        </ul>
                                    @else
                                        <span style="color:red">(تم حذفة من النظام)</span>
                                    @endif
                                </li>
                                <hr>
                                <li>نوع العقد : {{ $unitContract->type->toLabel() }}</li>
                                <hr>
                                <li>تاريخ التعاقد : {{ $unitContract->startDate->toDateString() }}</li>
                                <li>تاريخ انتهاء العقد : {{ $unitContract->endDate->toDateString() }}</li>
                                <hr>
                                <li>قيمة التأمين : {{ $unitContract->insuranceValue }}</li>
                                <li>قيمة الايجار عند التعاقد : {{ $unitContract->rentValue }} بواقع زيادة سنوية
                                    {{ $unitContract->annualRentIncreasement }}%
                                </li>
                                <li>قيمة الايجار الحالية :
                                    {{ $unitContract->isExpired() ? '----' : $unitContract->getCurrentRentValue() }}</li>
                                <hr>
                                <li>نسبة تحصيل فاتورة المياة المشتركة : بما يعادل
                                    {{ $unitContract->waterInvoicePercentage }} شقة سكنية</li>
                                <li>نسبة تحصيل فاتورة الكهرباء المشتركة : بما يعادل
                                    {{ $unitContract->waterInvoicePercentage }} شقة سكنية</li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>@endisset

    @endsection
