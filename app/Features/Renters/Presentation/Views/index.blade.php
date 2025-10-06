@extends('shared::main-layout')
@section('title', 'المستأجرين')
@section('active-renters', 'active')

@section('styles')
    {{-- CHANGE IT  --}}
    @vite('resources/css/features/renters/index.css')
@endsection
@section('scripts')
    {{-- CHANGE IT  --}}
    @vite('resources/ts/features/renters/index.ts')
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
            <a href="{{ route('renters.create') }}" class="btn btn-md btn-primary my-5">
                <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                <span> اضافة مستأجر</span>
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
                    @if (isset($renters) && count($renters))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>نوع الهوية</th>
                                    <th>رقم الهوية</th>
                                    <th>تليفون</th>
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renters as $renter)
                                    <td> {{ $renter->name }}</td>
                                    <td>{{ $renter->identityType->toLabel() ?? '----' }}</td>
                                    <td>{{ $renter->identityNumber ?? '----' }}</td>
                                    <td>
                                        @if ($renter->phones)
                                            @foreach ($renter->phones as $phone)
                                                {{ $phone->phone }} <br>
                                            @endforeach
                                        @else
                                            {{ '----' }}
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a style="margin-left:20px;text-decoration:none"
                                                href="{{ route('renters.show', ['renter' => $renter->id]) }}">
                                                <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                            </a>
                                            <a style="margin-left:20px;text-decoration:none"
                                                href="{{ route('renters.edit', ['renter' => $renter->id]) }}">
                                                <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                            </a>
                                            <form class="d-inline" action="{{ route('renters.destroy', $renter->id) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <i
                                                    class="delete-renter-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                    لا يوجد مستأجرين مسجلين حتى الان - قم باضافة مستأجر
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
