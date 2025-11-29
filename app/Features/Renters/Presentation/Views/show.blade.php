@extends('shared::main-layout')
@section('title', 'المستأجرين | عرض مستأجر')
@section('active-renters', 'active')
@section('breadcrumbs')
    @isset($renter)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('renters.show', $renter->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/renters/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/renters/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
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

        @isset($renter)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المستأجر</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('renters.edit', $renter->id) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('renters.destroy', $renter->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-renter-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-renter-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>الاسم : {{ $renter->name }}</li>
                                <hr>
                                <li>نوع الهوية : {{ $renter->identityType->toLabel() }}</li>
                                <hr>
                                <li>رقم الهوية : {{ $renter->identityNumber }}</li>
                                <hr>
                                <li>التليفون :
                                    @if (empty($renter->phones))
                                        <span>---</span>
                                    @else
                                        <ul>
                                            @foreach ($renter->phones as $phone)
                                                <li>{{ $phone->phone }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                <hr>
                                <li>ملاحظات :
                                    <pre>{{ $renter->notes ?? '---' }}</pre>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
</div>

@endsection
