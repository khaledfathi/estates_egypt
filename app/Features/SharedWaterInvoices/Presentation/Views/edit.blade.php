@php
    use App\Shared\Application\Utility\Month;
@endphp
@extends('shared::main-layout')
@section('title', 'سجل فواتير المياة المشتركة تحديث')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($sharedWaterInvoice)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.shared-water-invoices.edit', $estate->id, $unit->id, $unitContract->id, $sharedWaterInvoice->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/shared-water-invoices/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/shared-water-invoices/index.ts')
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
        @endif
        {{-- / Errors --}}

        @if (isset($unitContract))
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
                        <li>نسبة المشاركة فى فاتورة المياة المشتركة : بما يعادل {{ $unitContract->waterInvoicePercentage }}
                            شقة</li>
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

            {{-- shared water invoice form  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <form id="form" class="col-sm-12 col-md-10 col-lg-6" method="post"
                    action="{{ route('estates.units.contracts.shared-water-invoices.update' , ['estate'=>$estate->id, 'unit' => $unit->id ,'contract' => $unitContract->id, 'shared_water_invoice'=> $sharedWaterInvoice->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث سداد فاتورة مياة مشتركة</strong>
                        </div>
                        <div class="card-block">

                            {{-- transaction id --}}
                            <input type="hidden" name="transaction_id" value="{{ $sharedWaterInvoice->transactionId}}">
                            {{-- transaction id --}}

                            {{-- month --}}
                            <div class="form-group">
                                <label for="month">الشهر<span class="required">*</span></label>
                                <input name="month" type="text" class="form-control" id="month"
                                    placeholder="" value="{{ Month::from($sharedWaterInvoice->forMonth)->name}}" disabled>
                            </div>
                            {{-- / month --}}

                            {{-- year --}}
                            <div class="form-group">
                                <label for="year">العام<span class="required">*</span></label>
                                <input name="year" type="text" class="form-control" id="year"
                                    placeholder="" value="{{ $sharedWaterInvoice->forYear }}" disabled>
                            </div>
                            {{-- / year --}}

                            {{-- shared value --}}
                            <div class="form-group">
                                <label for="shared_value">قيمة المشاركة من الفاتورة <span class="required">*</span></label>
                                <input name="shared_value" type="text" class="form-control" id="shared_value"
                                    placeholder="" value="{{ round($sharedWaterInvoice->sharedValue) }}" disabled>
                            </div>
                            {{-- / shared value--}}

                            {{-- amount paid --}}
                            <div class="form-group">
                                <label for="amount">المبلغ المسدد<span class="required">*</span></label>
                                <input name="amount" type="text" class="form-control" id="amount"
                                    placeholder="" value="{{ $sharedWaterInvoice->transaction->amount }}">
                            </div>
                            {{-- / amount paid --}}

                            {{-- remaining --}}
                            <div class="form-group">
                                <label for="remaining">المبلغ المتبقى<span class="required">*</span></label>
                                <input name="remaining" type="text" class="form-control" id="remaining"
                                    placeholder="" value="{{ round($sharedWaterInvoice->getRemaining()) }}" disabled>
                            </div>
                            {{-- / remaining --}}

                            {{-- notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control" id="notes" placeholder="ملاحظات عن سداد فاتورة المياة المشتركة">{{ old('notes', $sharedWaterInvoice->transaction->description) }}</textarea>
                            </div>
                            {{-- / notes --}}

                            {{-- buttons --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ url()->current() }}"
                                    class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{ $previousURL }}" class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons --}}
                        </div>
                    </div>
                </form>
            </div>
            {{-- / shared water invoice form  --}}
        @endif
    </div>
@endsection
