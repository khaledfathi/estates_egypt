@extends('shared::main-layout')
@section('title', 'الحسابات | الخزينة - اضافة معاملة')
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

    {{--  transaction form --}}
    <div class="container" style="margin-top:30px">
        <div class="row" style="display:flex; justify-content: center;">
            <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
                <div class="card">
                    <div class="card-header">
                        <strong>معاملة مالية</strong>
                    </div>
                    <form class="card-block" id="owners-list-section" method="post"
                        action="{{ route('transactions.store') }}">
                        @csrf
                        {{--  date --}}
                        <div class="form-group">
                            <label for="date">تاريخ العملية <span class="required">*</span></label>
                            <input name="date" type="date" class="form-control" id="date"
                                value="{{ $currentDate }}">
                        </div>
                        <hr>
                        {{--  / date --}}

                        {{-- direction --}}
                        <div class="col">
                            @foreach ($transactionDirections as $value => $label)
                                <label class="radio-inline" style="margin-left:20px" for="radio-{{ $value }}">
                                    <input type="radio" id="radio-{{ $value }}" name="direction"
                                        value="{{ $value }}"
                                        {{ old('direction', $defaultTransactionDirection) == $value ? 'checked' : null }}>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        <hr>
                        {{-- amount --}}
                        <div class="form-group">
                            <label for="amount">المبلغ<span class="required">*</span></label>
                            <input name="amount" type="number" class="form-control" id="amount"
                                placeholder="المبلغ" value="{{ old('amount') }}">
                        </div>
                        {{-- / amount --}}

                        {{-- desctiption --}}
                        <div class="form-group">
                            <label for="description">وصف العملية</label>
                            <textarea name="description" class="form-control" id="description" placeholder="لماذا قمت بهذه العملية">{{ old('description') }}</textarea>
                        </div>
                        {{-- desctiption --}}

                        {{-- / direction --}}

                        <div class="form-group" style="margin-top: 40px">
                            <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                <i class="fa fa-plus-circle "></i>
                                تأكيد المعاملة</button>
                            <a href="{{ route('transactions.index') }}" class="btn btn-md btn-danger"><i
                                    class="fa fa-ban"></i>
                                الغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  / transaction form --}}


@endsection
