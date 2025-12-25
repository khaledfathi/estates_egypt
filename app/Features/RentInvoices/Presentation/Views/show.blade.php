@php
    use App\Shared\Application\Utility\Month;
@endphp
@extends('shared::main-layout')
@section('title', 'سجل الايجارات | عرض فاتورة سداد ايجار')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unitContract)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.rent-invoices.show', $estate->id, $unit->id, $unitContract->id, $rentInvoice->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/rent-invoices/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/rent-invoices/show.ts')
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

            {{-- show rent invoice form --}}

            <div class="row" style="display:flex; justify-content: center;">
                <div class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات ايصال سداد الايجار</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.units.contracts.rent-invoices.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'rent_invoice' => $rentInvoice->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates.units.contracts.rent-invoices.show', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'rent_invoice' => $rentInvoice->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-rent-invoice-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-rent-invoice-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>الملبغ المسدد : {{ $rentInvoice->transaction->amount }}</li>
                                <hr>
                                <li>عن شهر : {{ Month::from($rentInvoice->forMonth)->name }}</li>
                                <hr>
                                <li>عن عام : {{ $rentInvoice->forYear }}</li>
                                <hr>
                                <li>ملاحظات :
                                    <pre>{{ $rentInvoice->transaction->description }}</pre>
                                </li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- / show  rent invoice form --}}
        @endif
    </div>
@endsection
