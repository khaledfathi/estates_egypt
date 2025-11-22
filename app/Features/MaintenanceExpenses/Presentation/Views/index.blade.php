@extends('shared::main-layout')
@section('title', 'الحسابات | مصروفات الصيانة')
@section('active-accounting', 'active')

@section('content')
    <h1>مصروفات الصيانة</h1>
    <div class="container col-md-5">
        <form action="{{ route('estates-maintenance-expenses.index') }}"  method="get">
            @csrf
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
            <button class="btn btn-md btn-primary my-5" {{ count($estates) ? null : 'disabled' }}>
                <span>عرض المصروفات</span>
            </button>
        </form>
    </div>

    <pre class="col-md-12">
        select estate -> view  -> go to route( estate/{id}/maintenance/ [index] );

        information : 
            count of estates that have maintenance expnses
            total estates maintenance expenses 
            chart for year and set(12 month of expenses)
            
    </pre>
@endsection
