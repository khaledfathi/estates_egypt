@extends('shared::main-layout')
@section('title', 'الملاك | عرض مالك')
@section('active-owners', 'active')
@section('styles')
    @vite('resources/css/features/owners/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/owners/show.ts')
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

        @isset($owner)
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>بيانات المالك</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('owners.edit', $owner->id) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('owners.destroy', $owner->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <i id="delete-owner-btn"
                                        class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                    <input id="delete-owner-submit-btn" type="submit" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="card-block">
                            <ul>
                                <li>الاسم : {{ $owner->name }}</li><hr>
                                <li>الرقم القومى : {{ $owner->nationalId ?? '---'}}</li><hr>
                                <li>العنوان :
                                    <pre>{{ $owner->address ?? '---' }}</pre>
                                </li><hr>
                                <li>التليفون :
                                    @if (empty($owner->phones))
                                        <span>---</span>
                                    @else
                                        <ul>
                                            @foreach ($owner->phones as $phone)
                                                <li>{{ $phone->phone }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li><hr>
                                <li>ملاحظات :
                                    <pre> {{ $owner->notes ?? '---' }} </pre>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
</div>

@endsection
