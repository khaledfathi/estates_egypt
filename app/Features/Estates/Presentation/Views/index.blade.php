@extends('shared::main-layout')
@section('title', 'العقارات')
@section('active-estates', 'active')
@section('breadcrumbs')
    {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates') }}
@endsection
@section('styles')
    @vite('resources/css/features/estates/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estates/index.ts')
@endsection

@section('content')
    <div class="container-fluid">

        {{-- error message  --}}
        @if(session()->has('error'))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                <li>{{ session('error')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / error message  --}}

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

        <div class="card-block row">
            <a href="{{ route('estates.create') }}" class="btn btn-md btn-primary my-5">
                <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                <span> اضافة عقار</span>
            </a>
            <div class="container-fluid">

                {{-- top pagination  --}}

                @isset($pagination)
                    @if ($pagination->getPageCounts() > 1)
                        <ul class="pagination row">
                            <li class="page-item"><a class="page-link" href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                            </li>
                            @foreach ($pagination->getLinks() as $index => $link)
                                <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                        class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                </li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{ $pagination->getNextPageURL() }}">التالى</a>
                            </li>
                        </ul>
                    @endif
                @endisset($pagination)
                {{-- top pagination  --}}

                <div class="row">
                    @if (isset($estates) && count($estates))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>عدد الطوابق</th>
                                    <th>عدد الوحدات</th>
                                    <th>وحدات سكنية</th>
                                    <th>وحدات تجارية</th>
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estates as $estate)
                                    <tr>
                                        <td>{{ $estate->name }}</td>
                                        <td>{{ $estate->floorCount }}</td>
                                        <td>{{ $estate->unitCount}}</td>
                                        <td>{{ $estate->residentialUnitCount}}</td>
                                        <td>{{ $estate->commercialUnitCount}}</td>
                                        @php
                                        @endphp
                                        <td>
                                            <div>
                                                <a style="margin-left:20px;text-decoration:none"
                                                    href="{{ route('estates.show',['estate' => $estate->id]) }}">
                                                    <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                </a>
                                                <a style="margin-left:20px;text-decoration:none"
                                                    href="{{ route('estates.edit', ['estate' => $estate->id]) }}">
                                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                </a>
                                                <form class="d-inline" action="{{ route('estates.destroy', $estate->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <i class="delete-estate-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                    لا يوجد عقارات مسجلة حتى الان - قم باضافة عقار 
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
                            <li class="page-item"><a class="page-link" href="{{ $pagination->getNextPageURL() }}">التالى</a>
                            </li>
                        </ul>
                    @endif
                @endisset($pagination)

            </div>

            {{-- botom pagination  --}}
        </div>
    </div>

@endsection
