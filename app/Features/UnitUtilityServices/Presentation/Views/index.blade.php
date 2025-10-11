@extends('shared::main-layout')
@section('title', 'الوحدات | المرافق')
@section('active-estates', 'active')

@section('styles')
    @vite('resources/css/features/unit-utility-services/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/unit-utility-services/index.ts')
@endsection
@section('content')
    <div class="container-fluid">
        {{-- Errors --}}
        @if (isset($error) || session()->has('error'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if (isset($error))
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
                    <a href="{{ route('estates.units.index', $estate->id) }}"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-list fa-lg "></i> &nbsp; الذهاب لقائمة وحدات العقار</a>
                    <a href="{{ route('estates.units.show', ['estate' => $estate->id, 'unit' => $unit->id]) }}"
                        type="button" class="btn btn-primary">
                        <i class="fa fa-home fa-lg"></i> &nbsp; الذهاب للوحدة</a>
                </div>
            </div>
        @endif
        {{-- / unit information --}}

        @isset($unitUtilityServices)
            {{-- unit header title --}}
            <div class="card card-inverse card-info text-xs-center">
                <div class="card-block">
                    <h3>قائمة مرافق الوحدة </h3>
                </div>
            </div>
            {{-- / unit header title --}}
            <div class="card-block row">
                <a href="{{ route('estates.units.utility-services.create', ['estate'=> $estate->id ,'unit'=>$unit->id]) }}" class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span> اضافة مرفق</span>
                </a>
                <div class="container-fluid">

                    <div class="row">
                        @if (count($unitUtilityServices))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>نوع المرفق</th>
                                        <th>اسم المتعاقد</th>
                                        <th>رقم العداد</th>
                                        <th>رقم السداد الالكترونى</th>
                                        <th>تحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unitUtilityServices as $utilityService)
                                        <tr>
                                            <td>{{ $utilityService->type->toLabel() }}</td>
                                            <td>{{ $utilityService->ownerName }}</td>
                                            <td>{{ $utilityService->counterNumber ?? '----' }}</td>
                                            <td>{{ $utilityService->electronicPaymentNumber ?? '----' }}</td>
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.utility-services.show', ['estate' => $estate->id, 'unit'=>$unit->id ,'utility_service' => $utilityService->id]) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.utility-services.edit', ['estate' => $estate->id, 'unit'=>$unit->id ,'utility_service' => $utilityService->id]) }}">
                                                        <i
                                                            class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('estates.units.utility-services.destroy', ['estate' => $estate->id, 'unit'=>$unit->id ,'utility_service' => $utilityService->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i
                                                            class="delete-estate-document-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                        لا توجد مرافق مسجلة لهذة الوحدة حتى الان - قم باضافة مرفق
                                    </blockquote>
                                </div>
                            </div>

                            <p></p>
                        @endif
                    </div>
                </div>
        @endif
    </div>
@endsection
