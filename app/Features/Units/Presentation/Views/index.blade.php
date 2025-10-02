
@extends('shared::main-layout')
@section('title', 'الوحدات')
@section('active-estates', 'active')
@section('styles')
    @vite('resources/css/features/units/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/units/index.ts')
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


        @isset($units)
            {{-- unit header title --}}
            <div class="card card-inverse card-info text-xs-center">
                <div class="card-block">
                    <h3>قائمة الوحدات</h3>
                </div>
            </div>
            {{-- / unit header title --}}
            <div class="card-block row">
                <a href="{{ route('estates.units.create', $estate->id ) }}"
                    class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span> اضافة وحدة</span>
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
                        @if (count($units))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>رقم الوحدة</th>
                                        <th>الطابق</th>
                                        <th>نوع الوحدة</th>
                                        <th>نوع الملكية</th>
                                        <th>حالة الاشغال</th>
                                        <th>تحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($units as $unit)
                                        <tr>
                                            <td>{{ $unit->number }}</td>
                                            <td>{{ $unit->floorNumber == 0 ? 'الارضى' : $unit->floorNumber }}</td>
                                            <td>{{ $unit->type->toLabel() }}</td>
                                            <td>{{ $unit->ownershipType->toLabel() }}</td>
                                            <td>{{ $unit->isEmpty ? 'فارغة' : 'شاغرة' }}</td>
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.show', ['estate'=>$estate->id , 'unit' => $unit->id]) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.units.edit', ['estate' => $estate->id ,'unit' => $unit->id]) }}">
                                                        <i
                                                            class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline" action="{{ route('estates.units.destroy', ['estate'=> $estate->id , 'unit' => $unit->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i
                                                            class="delete-unit-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                        لا توجد وحدات مسجلة حتى الان - قم باضافة وحدة
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
