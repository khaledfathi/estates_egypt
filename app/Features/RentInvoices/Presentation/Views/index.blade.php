@php
    use App\Shared\Application\Utility\Month;
@endphp
@extends('shared::main-layout')
@section('title', 'سجل الايجارات ')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($rentInvoices)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.rent-invoices', $estate->id, $unit->id, $unitContract->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/rent-invoices/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/rent-invoices/index.ts')
@endsection

@section('content')
    <div class="container-fluid">
        @if (isset($unitContract))
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
        @endif
        <a href="{{ route('estates.units.contracts.rent-invoices.create', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id]) }}"
            class="btn btn-md btn-primary" style="margin-bottom: 15px">
            <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
            <span>تسجيل سداد ايجار</span>
        </a>
        <form style="width:300px;display:flex; flex-direction:row;" method="get" action="">
            <label style="width:160px;margin:auto" for="">ايجارات عام </label>
            <input class="form-control" type="number" name="year" value="{{ old('year', $selectedYear) }}">
            <input class="btn btn-primary" type="submit" value="عرض">
        </form>

        {{-- Invoices --}}
        <div class="row">
            <hr>
            @if ($rentInvoices)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>عن شهر</th>
                            <th>عن عام</th>
                            <th>المبلغ المسدد</th>
                            <th>متبقى</th>
                            <th>حالة السداد</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentInvoices as $rentInvoice)
                            <tr>
                                <td>{{ Month::from($rentInvoice->forMonth)->name }}</td>
                                <td>{{ $rentInvoice->forYear }}</td>
                                <td>{{ $rentInvoice->transaction->amount }}</td>
                                @php
                                    $remindRentValue =
                                        $unitContract->getCurrentRentValue() - $rentInvoice->transaction->amount;
                                @endphp
                                <td>{{ $remindRentValue > 0 ? $remindRentValue : 0 }}</td>
                                <td>{{ $remindRentValue >= 0 ? 'غير مكتمل' : 'مكتمل' }}</td>
                                <td>
                                    <div>
                                        <a style="margin-left:20px;text-decoration:none"
                                            href="{{ route('estates.units.contracts.rent-invoices.show', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'rent_invoice' => $rentInvoice->id]) }}">
                                            <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                        </a>
                                        <a style="margin-left:20px;text-decoration:none" href="{{ route('estates.units.contracts.rent-invoices.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'rent_invoice' => $rentInvoice->id]) }}">
                                            <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                        </a>
                                        <form class="d-inline" action="{{ route('estates.units.contracts.rent-invoices.destroy' , ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'rent_invoice' => $rentInvoice->id] ) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <i
                                                class="delete-rent-invoice-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                            <input class="delete-submit-btn" type="submit" hidden>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                </table>
            @else
                <div class="card card-inverse card-primary text-xs-center">
                    <div class="card-block">
                        <blockquote class="card-blockquote">
                            لا توجد ايجارات مسددة لهذا العام - قم بتسجيل سداد ايجار
                        </blockquote>
                    </div>
                </div>

                <p></p>
            @endif
        </div>
        {{--  --}}
    </div>
@endsection
