@extends('shared::main-layout')
@section('title', 'سجل الايجارات ')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($rentsPayment)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.contracts.rents-payment', $estate->id , $unit->id , $unitContract->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/renters/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/renters/index.ts')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- contract information --}}
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
                                        value="{{ $unitContract->getMonthsPassedPercentage() }}"
                                        max="100"></progress>
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
            </div>
</div>
</div>
</div>
@endif
{{-- / contract information --}}

<h1>سجل الايجارات</h1>
<ul>
    <li>estate info</li>
    <li>unit info</li>
    <li>contract info</li>
</ul>
@endsection
