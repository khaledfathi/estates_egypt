@extends('shared::main-layout')
@section('title', 'الاعدادات')

@section('content')
    <h1>الاعدادات</h1>

    {{-- <div class="container">
        <form class="col-md-12">
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="select">عدد النتائج فى الصفحة</label>
                <div class="col-md-3">
                    <select id="select" name="" class="form-control" size="1">
                        @php
                        $options = [10,15,20,25,50,100];
                        @endphp
                        @foreach ($options as $option)
                            <option value="{{$option}}" {{$settingPageCounts == $option ? "selected" : null}}>{{$option}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> اعادة</button>
                </div>

            </div>
        </form>
    </div> --}}
@endsection
