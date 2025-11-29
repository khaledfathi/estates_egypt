@extends('shared::main-layout')
@section('title', 'الحسابات | اضافة مصروف صيانة')
@section('active-accounting', 'active')
@section('breadcrumbs')
    @isset($estate)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.maintenance-expenses.create', $estate->id) }}
    @endisset
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
                </div>
            </div>
            {{-- / estaet information  --}}


            {{-- create estate maintenance expense --}}
            <div class="container" style="margin-top:30px">
                <div class="row" style="display:flex; justify-content: center;">
                    <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
                        <div class="card">
                            <div class="card-header">
                                <strong>اضافة مصروف صيانة</strong>
                            </div>
                            <form class="card-block" id="owners-list-section" method="post"
                                action="{{ route('estates.maintenance-expenses.store' , ['estate' => $estate->id]) }}">
                                @csrf

                                {{-- estaet id --}}
                                <input type="hidden" name="estate_id" value="{{ $estate->id }}">
                                {{-- estaet id --}}

                                {{-- date --}}
                                <div class="form-group">
                                    <label for="date">تاريخ العملية <span class="required">*</span></label>
                                    <input name="date" type="date" class="form-control" id="date"  value="{{ old('date', $currentDate ) }}">
                                </div>
                                <hr>
                                {{-- / date --}}

                                {{-- amount --}}
                                <div class="form-group">
                                    <label for="amount">المبلغ<span class="required">*</span></label>
                                    <input name="amount" type="number" class="form-control" id="amount"
                                        placeholder="المبلغ" value="{{ old('amount') }}">
                                </div>
                                {{-- /amount --}}

                                {{-- title --}}
                                <div class="form-group">
                                    <label for="title">مدفوع لـ<span class="required">*</span></label>
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="وصف بسيط لعملية الصيانة" value="{{ old('title') }}">
                                </div>
                                {{-- /title --}}

                                {{-- description --}}
                                <div class="form-group">
                                    <label for="description">وصف تفصيلى</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="تفاصيل اكثر عن عملية الصيانة">{{ old('description') }}</textarea>
                                </div>
                                {{-- description --}}

                                {{-- buttons --}}
                                <div class="form-group" style="margin-top: 40px">
                                    <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                                        <i class="fa fa-plus-circle "></i>
                                        تأكيد المعاملة</button>
                                    <a href="{{ $backUrl }}" class="btn btn-md btn-danger"><i class="fa fa-ban"></i>
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
