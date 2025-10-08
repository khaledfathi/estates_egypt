@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الوحدات | عرض وحدة')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/estate-utility-serviecs/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-utility-serviecs/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
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

        @isset($estateUtilityService)
            {{-- estaet information  --}}
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                    </ul>
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.utility-services.index',  $estate->id ) }}" type="button"
                        class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة مرافق العقار</a>
                </div>
            </div>
            {{-- / estaet information  --}}

            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المرفق</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none" href="{{ route('estates.utility-services.edit', ['estate' => $estate->id ,'utility_service'=> $estateUtilityService->id]) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('estates.utility-services.destroy',['estate'=> $estate->id , 'utility_service' => $estateUtilityService->id] ) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-utility-service-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-utility-service-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            {{-- service type --}}

                            <div class="form-group">
                                <label for="type">نوع المرفق<span class="required">*</span></label>
                                <input name="type" type="text" class="form-control" id="type"
                                    value="{{$estateUtilityService->type->toLabel() }}" readonly>
                            </div>
                            {{-- service type --}}

                            {{-- owner name --}}
                            <div class="form-group">
                                <label for="owner_name">اسم مالك العداد<span class="required">*</span></label>
                                <input name="owner_name" type="text" class="form-control" id="owner_name"
                                    placeholder="الاسم المسجل على الايصال" value="{{$estateUtilityService->ownerName}}" readonly>
                            </div>
                            {{-- / owner name --}}

                            {{-- counter number --}}
                            <div class="form-group">
                                <label for="counter_number">رقم العداد</label>
                                <input name="counter_number" type="text" class="form-control" id="counter_number"
                                    placeholder="رقم عداد المرفق" value="{{$estateUtilityService->counterNumber}}" readonly>
                            </div>
                            {{-- / counter number --}}

                            {{-- electronic payment number --}}
                            <div class="form-group">
                                <label for="electronic_payment_number">رقم الدفع الالكترونى</label>
                                <input name="electronic_payment_number" type="text" class="form-control"
                                    id="electronic_payment_number" placeholder="رقم الدفع الالكترونى المسجل على الايصال "
                                    value="{{$estateUtilityService->electronicPaymentNumber}}" readonly>
                            </div>
                            {{-- / electronic payment number --}}

                            {{-- notes --}}
                            <div class="form-group">
                                <label for="notes">ملاحظات</label>
                                <textarea name="notes" class="form-control" id="notes" placeholder="تفاصيل اخرى" readonly>{{$estateUtilityService->notes}}</textarea>
                            </div>
                            {{-- / notes --}}
                        
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
