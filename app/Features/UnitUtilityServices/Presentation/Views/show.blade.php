@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الوحدات | عرض مرفق الوحدة')
@section('active-estates', 'active')
@section('breadcrumbs')
    @isset($unit)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.units.utility-services.show', $estate->id , $unit->id , $unitUtilityService->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/unit-utility-services/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/unit-utility-services/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || session()->has('error') || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif(session('error'))
                                    <li>{{ session('error') }}</li>
                                @elseif(isset($error))
                                        <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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

        @isset($unitUtilityService)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المرفق</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('estates.units.utility-services.edit', ['estate' => $estate->id, 'unit' => $unit->id, 'utility_service' => $unitUtilityService->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline"
                                    action="{{ route('estates.units.utility-services.destroy', ['estate' => $estate->id, 'unit' => $unit->id, 'utility_service' => $unitUtilityService->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-utility-service-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-utility-service-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>نوع المرفق : {{ $unitUtilityService->type->toLabel() }}</li>
                                <hr>
                                <li>اسم مالك العداد : {{ $unitUtilityService->ownerName }}</li>
                                <hr>
                                <li>رقم العداد : {{ $unitUtilityService->counterNumber ?? '---' }}</li>
                                <hr>
                                <li>رقم الدفع الالكترونى : {{ $unitUtilityService->electronicPaymentNumber ?? '---' }}</li>
                                <hr>
                                <li>ملاحظات :
                                    <pre>{{ $unitUtilityService->notes ?? '---' }}</pre>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
