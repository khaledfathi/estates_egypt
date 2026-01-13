@php
    use App\Shared\Application\Utility\Month;
@endphp
@extends('shared::main-layout')
@section('title', 'سجل فواتير المياة المشتركة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unitContract)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.shared-water-invoices', $estate->id, $unit->id, $unitContract->id) }}
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
        @endif
        <form style="width:300px;display:flex; flex-direction:row;" method="get" action="">
            <label style="width:160px;margin:auto" for="">فواتير عام </label>
            <input class="form-control" type="number" name="year" value="{{ old('year', $selectedYear) }}">
            <input class="btn btn-primary" type="submit" value="عرض">
        </form>

        {{-- water invoices list  --}}
        @if (count($sharedWaterInvoices))
            <hr>
            <div class ="container-fluid ">
                <h5 style="text-align:center">قائمة فواتير المياة</h5>
                <div class="card-block">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>فاتورة شهر</th>
                                <th>العام</th>
                                <th>قيمة المشاركة من الفاتورة</th>
                                <th>المبلغ المسدد</th>
                                <th>المبلغ المتبقى</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sharedWaterInvoices as $invoice)
                                <tr>
                                    <td>{{ Month::from($invoice->forMonth)->name }}</td>
                                    <td>{{ $invoice->forYear }}</td>
                                    <td>{{ round($invoice->sharedValue) }}</td>
                                    @php
                                        $amount = $invoice->transaction->amount;
                                    @endphp
                                    <td>{{$amount}} <span style="color:green">{{ $amount > $invoice->sharedValue ? '+' : null }}</span></td>
                                    @php
                                        $remaining = round($invoice->sharedValue - $invoice->transaction->amount) 
                                    @endphp
                                    <td style="color:{{ $remaining > 0 ? 'red' : 'green' }}">{{ $remaining > 0 ? $remaining : 0 }}</td>
                                    <td>
                                        <div>
                                            <a style="margin-left:20px;text-decoration:none"
                                                href="{{ route('estates.units.contracts.shared-water-invoices.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'contract' => $unitContract->id, 'shared_water_invoice' => $invoice->id]) }}">
                                                <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        {{-- / water invoices list  --}}
    </div>
@endsection
