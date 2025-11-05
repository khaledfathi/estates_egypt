@extends('shared::main-layout')
@section('title', 'الحسابات')
@section('active-transaction', 'active')

@section('content')
    {{-- balance --}}
    <div class="container" style="margin-top:20px">
        <div class="card card-inverse card-primary">
            <div class="card-header">
                رصيد الخزينة (كل الوقت)
            </div>
            <div class="card-block">
                <div style="padding:10px 0;text-align:center;border-bottom: 3px solid white">
                    <h5>الرصيد 2500</h5>
                </div>
                <div style="display:flex; wrap:wrap; text-align: center;">
                    <div style="padding-top:20px;width:50%; border-left:3px solid white">
                        <h5>دائن</h5>
                        <span>12500</span>
                    </div>
                    <div style="padding-top:20px; width:50%">
                        <h5>مدين</h5>
                        <span>10000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- / balance --}}

    {{--  transaction form --}}
    <div class="row" style="display:flex; justify-content: center;">
        <div id="" class="col-sm-12 col-md-10 col-lg-6" method="post">
            <div class="card">
                <div class="card-header">
                    <strong>معاملة مالية</strong>
                </div>
                <form class="card-block" id="owners-list-section" method="post" action="{{ route('transactions.store') }}">
                    @csrf
                    {{-- direction --}}
                    <div class="col">
                        <label class="radio-inline" for="inline-radio1">
                            <input type="radio" id="inline-radio1" name="direction" value="withdraw" checked>
                            سحب
                        </label>
                        <label class="radio-inline" for="inline-radio3" style="margin-right:20px">
                            <input type="radio" id="inline-radio3" name="direction" value="deposit">
                            ايداع
                        </label>
                    </div>
                    <hr>
                    {{-- amount --}}
                    <div class="form-group">
                        <label for="amount">المبلغ<span class="required">*</span></label>
                        <input name="amount" type="number" class="form-control" id="amount"
                            placeholder="المبلغ" value="">
                    </div>
                    {{-- / amount --}}

                    {{-- desctiption --}}
                    <div class="form-group">
                        <label for="description">وصف العملية</label>
                        <textarea name="description" class="form-control" id="description" placeholder="لماذا قمت بهذه العملية"></textarea>
                    </div>
                    {{-- desctiption --}}

                    {{-- / direction --}}

                    <div class="form-group" style="margin-top: 40px">
                        <button id="submit-btn" type="submit" class="btn btn-md btn-success">
                            <i class="fa fa-plus-circle "></i>
                            تأكيد المعاملة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  / transaction form --}}


@endsection
