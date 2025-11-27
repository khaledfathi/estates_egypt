@extends('shared::main-layout')
@section('title', 'الحسابات | مصروفات الصيانة')
@section('active-accounting', 'active')
@section('scripts')
    @vite('resources/ts/features/accounting-management/index.ts')
@endsection

@section('content')
    <h1>ادارة الحسابات </h1>
    <div class="container col-md-5">
        {{-- form action is set by JS/TS submit buttons with attribute --}}
        <form id="account-management-form" action=""  method="get">
            {{-- estate  --}}
            <div class="form-group">
                <label for="estate_id">اختر العقار<span class="required">*</span></label>
                <select id="estate_id" name="estate_id" class="form-control" size="1">
                    @if (!count($estates))
                        <option value="0"> ---- </option>
                    @endif
                    @foreach ($estates as $estate)
                        <option value="{{ $estate->id }}"> {{ $estate->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- / estate  --}}
            
            {{-- buttons --}}
            <button id="maintenance-expenses-btn" class="btn btn-md btn-primary my-5" {{ count($estates) ? null : 'disabled' }} 
                data-form-action="{{ route('estates-maintenance-expenses.index') }}">
                <span>مصروفات الصيانة</span>
            </button>
            <button id="rents-payment-btn" class="btn btn-md btn-primary my-5" {{ count($estates) ? null : 'disabled' }} 
                data-form-action="{{ route('rents-payments.index') }}">
                <span>سداد الايجارات</span>
            </button>
            <button id="estate-utilitiy-services-invoices-btn" class="btn btn-md btn-primary my-5" {{ count($estates) ? null : 'disabled' }} 
                data-form-action="">
                <span>سداد فواتير المرافق</span>
            </button>
            {{-- / buttons --}}
        </form>
    </div>
@endsection
