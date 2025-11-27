@extends('shared::main-layout')
@section('title', 'الخزينة | تحديث معاملة')
@section('active-transactions', 'active')

@section('content')
    {{-- Errors --}}
    @if ($errors->any() || session()->has('error') || isset($error))
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
                            @elseif (isset($error))
                                <li>{{ $error }}</li>
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

    {{--  transaction form --}}
    @isset($transaction)
        <div class="container" style="margin-top:30px">
            <div class="row" style="display:flex; justify-content: center;">
                <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
                    <div class="card">
                        <div class="card-header">
                            <strong>تحديث معاملة مالية</strong>
                        </div>
                        <form class="card-block" id="owners-list-section" method="post"
                            action="{{ route('transactions.update', $transaction->id) }}">
                            @csrf
                            @method('put')
                            {{--  date --}}
                            <div class="form-group">
                                <label for="date">تاريخ العملية <span class="required">*</span></label>
                                <input name="date" type="date" class="form-control" id="date"
                                    value="{{ old('date', $transaction->date->toDateString()) }}">
                            </div>
                            <hr>
                            {{--  / date --}}

                            {{-- direction --}}
                            <div class="col">
                                @foreach ($transactionDirections as $value => $label)
                                    <label class="radio-inline" style="margin-left:20px"
                                        for="radio-{{ $value }}">
                                        <input type="radio" id="radio-{{ $value }}" name="direction"
                                            value="{{ $value }}"
                                            {{ old('direction', $transaction->direction->value) == $value ? 'checked' : null }}>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            <hr>
                            {{-- amount --}}
                            <div class="form-group">
                                <label for="amount">المبلغ<span class="required">*</span></label>
                                <input name="amount" type="number" class="form-control" id="amount"
                                    placeholder="المبلغ" value="{{ old('amount', abs($transaction->amount)) }}">
                            </div>
                            {{-- / amount --}}

                            {{-- desctiption --}}
                            <div class="form-group">
                                <label for="description">وصف العملية</label>
                                <textarea name="description" class="form-control" id="description" placeholder="لماذا قمت بهذه العملية">{{ old('description', $transaction->description) }}</textarea>
                            </div>
                            {{-- / direction --}}

                            {{-- buttons  --}}
                            <div class="form-group" style="margin-top: 40px">
                                <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-edit "></i>
                                    تحديث</button>
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-md btn-primary">
                                    <i class="fa fa-refresh "></i>
                                    اعادة</a>
                                <a href="{{ $previousURL}}" class="btn btn-md btn-danger">
                                    <i class="fa fa-ban"></i>
                                    الغاء</a>
                            </div>
                            {{-- / buttons  --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    {{--  / transaction form --}}

@endsection
