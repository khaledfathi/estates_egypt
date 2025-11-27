@php
    use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
@endphp
@extends('shared::main-layout')
@section('title', 'الحسابات | تحديث مصروف صيانة')
@section('active-accounting', 'active')
@section('styles')
    @vite('resources/css/features/estate-maintenance-expenses/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-maintenance-expenses/show.ts')
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

        @isset($estate)
            {{-- estaet information  --}}
            <div class="card">
                <div class="card-header">
                    بيانات العقار
                </div>
                <div class="card-block">
                    <ul>
                        <li>اسم العقار : {{ $estate->name }}</li>
                        <li>عدد الطوابق : {{ $estate->floorCount }}</li>
                        <li> العنوان :
                            <pre>{{ $estate->address }}</pre>
                        </li>
                    </ul>
                    <a href="{{ route('estates.show', $estate->id) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-building fa-lg"></i>&nbsp; الذهاب للعقار</a>
                    <a href="{{ route('estates.maintenance-expenses.index' , ['estate' => $estate->id]) }}" type="button" class="btn btn-primary">
                        <i class="fa fa-dollar fa-lg"></i> &nbsp; الذهاب لقائمة المصروفات</a>
                </div>
            </div>
            {{-- / estaet information  --}}


            {{-- create estate maintenance expense --}}
            <div class="container" style="margin-top:30px">
                <div class="row" style="display:flex; justify-content: center;">
                    <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
                        <div class="card">
                            <div class="card-header">
                                <strong>تحديث مصروف صيانة</strong>
                            </div>
                            <form class="card-block" id="owners-list-section" method="post"
                                action="{{ route('estates.maintenance-expenses.update', ['estate' => $estate->id , 'maintenance_expense' => $estateMaintenanceExpense->id]) }}">
                                @csrf
                                @method('put')
                                {{-- estaet id --}}
                                <input type="hidden" name="estate_id" value="{{ $estate->id }}">
                                {{-- estaet id --}}

                                {{-- transaction id --}}
                                <input type="hidden" name="transaction_id" value="{{ $estateMaintenanceExpense->transaction->id }}">
                                {{-- / transaction id --}}

                                {{-- date --}}
                                <div class="form-group">
                                    <label for="date">تاريخ العملية <span class="required">*</span></label>
                                    <input name="date" type="date" class="form-control" id="date"
                                        value="{{ old('date', $estateMaintenanceExpense->transaction->date->toDateString()) }}">
                                </div>
                                <hr>
                                {{-- / date --}}

                                {{-- amount --}}
                                <div class="form-group">
                                    <label for="amount">المبلغ<span class="required">*</span></label>
                                    <input name="amount" type="number" class="form-control" id="amount"
                                        placeholder="المبلغ"
                                        value="{{ abs(old('amount', $estateMaintenanceExpense->transaction->amount)) }}">
                                </div>
                                {{-- /amount --}}

                                {{-- title --}}
                                <div class="form-group">
                                    <label for="title">مدفوع لـ<span class="required">*</span></label>
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="وصف بسيط لعملية الصيانة"
                                        value="{{ old('title', $estateMaintenanceExpense->title) }}">
                                </div>
                                {{-- /title --}}

                                {{-- description --}}
                                <div class="form-group">
                                    <label for="description">وصف تفصيلى</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="تفاصيل اكثر عن عملية الصيانة">{{ old('description', $estateMaintenanceExpense->description) }}</textarea>
                                </div>
                                {{-- description --}}

                                {{-- buttons --}}
                                <div class="form-group" style="margin-top: 40px">
                                    <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                        <i class="fa fa-edit "></i>
                                        تحديث</button>
                                    <a href="{{ url()->current() }}" class="btn btn-md btn-primary">
                                        <i class="fa fa-refresh "></i>
                                        اعادة</a>
                                    <a href="{{ $previousURL }}" class="btn btn-md btn-danger">
                                        <i class="fa fa-ban"></i>
                                        الغاء</a>
                                </div>
                                {{-- / buttons --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- create estate maintenance expense --}}
        @endisset
    </div>
@endsection
