@extends('shared::main-layout')
@section('title', 'الحسابات')
@section('active-transaction', 'active')

@section('content')
    {{-- Errors --}}
    @if ($errors->any() || session()->has('error'))
        <div class="row" style="display:flex; justify-content:center;">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="card card-inverse card-danger ">
                    <div class="card-block">
                        <ul>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
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

    {{-- balance --}}
    <div class="container" style="margin-top:20px">
        <div class="card card-inverse card-primary">
            <div class="card-header">
                رصيد الخزينة (كل الوقت)
            </div>
            <div class="card-block">
                <div style="padding:10px 0;text-align:center;border-bottom: 3px solid white">
                    <h5>الرصيد 2500</h5>
                </div>
                <div style="display:flex; wrap:wrap; text-align: center;">
                    <div style="padding-top:20px;width:50%; border-left:3px solid white">
                        <h5>ايرادات</h5>
                        <span>12500</span>
                    </div>
                    <div style="padding-top:20px; width:50%">
                        <h5>مصروفات</h5>
                        <span>10000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- / balance --}}

    {{--  --}}
    <div class="card-block row">
        <a href="{{ route('transactions.create') }}" class="btn btn-md btn-primary my-5">
            <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
            <span>اضافة معاملة</span>
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
                                    <td>{{ $estate->unitCount }}</td>
                                    <td>{{ $estate->residentialUnitCount }}</td>
                                    <td>{{ $estate->commercialUnitCount }}</td>
                                    @php
                                    @endphp
                                    <td>
                                        <div>
                                            <a style="margin-left:20px;text-decoration:none"
                                                href="{{ route('estates.show', ['estate' => $estate->id]) }}">
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
                                                <i
                                                    class="delete-estate-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                لا توجد معاملات مالية مسجلة لهذا اليوم - قم باضافة معاملة 
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


@endsection
