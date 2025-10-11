@extends('shared::main-layout')
@section('title', 'مرافق العقار')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/estate-utility-serviecs/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-utility-serviecs/index.ts')
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

        {{-- estaet information  --}}
        @isset($estate)
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li>عدد الوحدات : {{ $estate->unitCount }} ( سكنى {{ $estate->residentialUnitCount }} ) - ( تجارى
                            {{ $estate->commercialUnitCount }})</li>
                    </ul>
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                </div>
            </div>
        @endisset
        {{-- / estaet information  --}}


        @isset($estateUtilityServices)
            {{-- unit header title --}}
            <div class="card card-inverse card-info text-xs-center">
                <div class="card-block">
                    <h3>قائمة مرافق العقار</h3>
                </div>
            </div>
            {{-- / unit header title --}}
            <div class="card-block row">
                <a href="{{ route('estates.utility-services.create', $estate->id ) }}"
                    class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span> اضافة مرفق</span>
                </a>
                <div class="container-fluid">

                    {{-- top pagination  --}}

                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)
                    {{-- top pagination  --}}

                    <div class="row">
                        @if (count($estateUtilityServices))
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
                                    @foreach ($estateUtilityServices as $utilityService)
                                        <tr>
                                            <td>{{ $utilityService->type->toLabel()}}</td>
                                            <td>{{ $utilityService->ownerName}}</td>
                                            <td>{{ $utilityService->counterNumber ?? '----'}}</td>
                                            <td>{{ $utilityService->electronicPaymentNumber ??  '----'}}</td>
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.utility-services.show', ['estate'=>$estate->id , 'utility_service' => $utilityService->id]) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.utility-services.edit', ['estate' => $estate->id ,'utility_service' => $utilityService->id]) }}">
                                                        <i
                                                            class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline" action="{{ route('estates.utility-services.destroy', ['estate'=> $estate->id , 'utility_service' => $utilityService->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i
                                                            class="delete-utility-service-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                        لا توجد مرافق مسجلة حتى الان - قم باضافة مرفق 
                                    </blockquote>
                                </div>
                            </div>

                            <p></p>
                        @endif
                    </div>

                    {{-- botom pagination  --}}
                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)

                </div>

                {{-- botom pagination  --}}
            </div>
        @endif

    </div>
@endsection
