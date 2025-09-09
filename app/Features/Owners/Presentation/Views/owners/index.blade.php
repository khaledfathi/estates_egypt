@extends('main-layout')
@section('title', 'الملاك')
@section('active-owners', 'active')
@section('styles')
    @vite('resources/css/features/owners/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/owners/index.ts')
@endsection

@section('content')
    <div class="container-fluid">
        {{-- error message  --}}
        @isset($error)
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                <li>{{ $error }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset($error)
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
            <a href="{{ route('owners.create') }}" class="btn btn-md btn-primary my-5">
                <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                <span> اضافة مالك</span>
            </a>
            <div class="container-fluid">

                {{-- botom pagination  --}}
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
                {{-- botom pagination  --}}
                <div class="row">
                    @if (count($owners))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الرقم القومى</th>
                                    <th>تليفون</th>
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owners as $owner)
                                    <tr>
                                        <td>{{ $owner->name }}</td>
                                        <td>{{ $owner->nationalId ?? '----' }}</td>
                                        <td>
                                            @if ($owner->phones)
                                                @foreach ($owner->phones as $phone)
                                                    {{ $phone }} <br>
                                                @endforeach
                                            @else
                                                {{ '----' }}
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a style="margin-left:20px;text-decoration:none"
                                                    href="{{ route('owners.show', ['owner' => $owner->id]) }}">
                                                    <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                </a>
                                                <a style="margin-left:20px;text-decoration:none"
                                                    href="{{ route('owners.edit', ['owner' => $owner->id]) }}">
                                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                </a>
                                                <form class="d-inline" action="{{ route('owners.destroy', $owner->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <i class="delete-owner-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
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
                                    لا يوجد ملاك مسجلين حتى الان - قم باضافة مالك 
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
