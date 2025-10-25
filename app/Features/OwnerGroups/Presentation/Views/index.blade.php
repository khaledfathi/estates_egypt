@extends('shared::main-layout')
@section('title', 'مجموعات الملاك')
@section('active-owners', 'active')
@section('styles')
    @vite('resources/css/features/owner-groups/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/owner-groups/index.ts')
@endsection

@section('content')
    <div class="container-fluid">

        {{-- error message  --}}
        @if (session()->has('error') || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if (session()->has('error'))
                                    <li>{{ session('error') }}</li>
                                @elseif (isset($error))
                                    <li>{{ $error }}</li>
                                @endif
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

        {{-- header buttons section --}}
        <div class="container">
            <a href="{{ route('owners.index') }}" class="btn btn-md btn-secondary my-5">
                <i class="icon-people fa-lg d-inline-block"></i>
                <span>الملاك</span>
            </a>
        </div>
        <hr>
        {{-- / header buttons section --}}

        @isset($ownerGroups)
            <div class="card-block row">
                <a href="{{ route('owner-groups.create') }}" class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span>اضافة مجموعة للملاك</span>
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
                        @if ($ownerGroups)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>اسم المجموعة</th>
                                        <th>افراد المجموعة</th>
                                        <th>تحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ownerGroups as $ownerGroup)
                                        <tr>
                                            <td>{{ $ownerGroup->name }}</td>
                                            <td>{{ $ownerGroup->ownersCount }}</td>
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('owner-groups.show', $ownerGroup->id) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('owner-groups.edit', $ownerGroup->id) }}">
                                                        <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('owner-groups.destroy', $ownerGroup->id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i
                                                            class="delete-owner-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                        لا توجد مجموعات ملاك مسجلة حتى الان - قم باضافة مجموعة
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
        @endisset
    </div>

@endsection
