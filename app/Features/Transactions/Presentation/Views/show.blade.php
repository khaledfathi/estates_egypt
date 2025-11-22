@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الحسابات | الخزينة - عرض معاملة')
@section('active-transaction', 'active')

@section('styles')
    @vite('resources/css/features/units/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/units/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">
        {{-- Errors --}}
        @if ($errors->any() || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif(isset($error))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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

        @isset($transaction)

            {{-- header buttons section --}}
            <div class="container">
                <a href="{{ route('transactions.index') }}" class="btn btn-md btn-secondary my-5">
                    <i class="fa fa-dollar fa-lg d-inline-block"></i>
                    <span>الخزينة</span>
                </a>
            </div> <hr>
            {{-- / header buttons section --}}
            <div class="row" style="display:flex; justify-content: center;">
                <div id="form" class="col-sm-12 col-md-10 col-lg-6">
                    <div class="card">
                        <div class="edit-box-header">
                            <strong>عرض بيانات المعاملة</strong>
                            <div>
                                <a style="margin-left:10px;text-decoration:none"
                                    href="{{ route('transactions.edit', $transaction->id) }}">
                                    <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                </a>
                                <form class="d-inline" action="{{ route('transactions.destroy', $transaction->id) }}"
                                    method="post">
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
                                <li>التاريخ : {{ $transaction->date->toDateString() }}</li>
                                <hr>
                                <li>نوع العملية : 
                                    <span style="color:{{ $transaction->isWithdraw() ? 'red' : 'green' }}">{{ $transaction->direction->toLabel() }}</span>
                                </li>
                                <hr>
                                <li>المبلغ : 
                                    <span style="color:{{ $transaction->isWithdraw() ? 'red' : 'green' }}"> {{ abs($transaction->amount) }} </span>
                                </li>
                                <hr>
                                <li>وصف العملية :
                                    <pre>{{ $transaction->description ?? '----' }}</pre>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
