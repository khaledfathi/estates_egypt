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
                            <ul>
                                <li>نوع المرفق : {{$estateUtilityService->type->toLabel()}}</li><hr>
                                <li>اسم مالك العداد : {{$estateUtilityService->ownerName}}</li><hr>
                                <li>رقم العداد : {{$estateUtilityService->counterNumber ?? '---'}}</li><hr>
                                <li>رقم الدفع الالكترونى : {{$estateUtilityService->electronicPaymentNumber ?? '---'}}</li><hr>
                                <li>ملاحظات : <pre></pre>{{$estateUtilityService->notes ?? '---'}}</pre></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
