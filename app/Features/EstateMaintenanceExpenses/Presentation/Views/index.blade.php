@extends('shared::main-layout')
@section('title', 'الحسابات | مصروفات صيانة')
@section('active-accounting', 'active')
@section('breadcrumbs')
    @isset($estate)
        {{ Diglactic\Breadcrumbs\Breadcrumbs::render('estates.maintenance-expenses', $estate->id) }}
    @endisset
@endsection
@section('styles')
    @vite('resources/css/features/estate-maintenance-expenses/index.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/estate-maintenance-expenses/index.ts')
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
        @endisset

        {{-- estate maintenance expenses  --}}
        @isset($estateMaintenanceExpenses)
            {{-- title block --}}
            <div class="card card-inverse card-info text-xs-center">
                <div class="card-block">
                    <h3>قائمة مصروفات الصيانة</h3>
                </div>
            </div>
            {{-- / title block --}}
            <div class="card-block row">
                <a href="{{ route('estates.maintenance-expenses.create', ['estate' => $estate->id]) }}"
                    class="btn btn-md btn-primary my-5">
                    <i class="fa fa-plus-circle fa-lg d-inline-block"></i>
                    <span> اضافة مصروف صيانة</span>
                </a>
                <div class="container-fluid">
                    <form style="margin-bottom:20px;width:340px;display:flex; flex-direction:row;" method="get"
                        action="{{ route('estates.maintenance-expenses.index', ['estate' => $estate->id]) }}">
                        <label style="width:180px;margin:auto" for="">معاملات عام</label>
                        <input class="form-control" type="number" name="selected_year" value="{{ old('selected_year' , $selectedYear) }}">
                        <input class="btn btn-primary" type="submit" value="عرض">
                    </form>
                    {{-- top pagination  --}}
                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link" href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link" href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)
                    {{-- top pagination  --}}

                    <div class="row">
                        @if (count($estateMaintenanceExpenses))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>التاريخ</th>
                                        <th>المبلغ المصروف</th>
                                        <th>وصف مبسط</th>
                                        <th>تحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estateMaintenanceExpenses as $maintenanceExpense)
                                        <tr>
                                            <td>{{ $maintenanceExpense->transaction->date->toDateString() }}</td>
                                            <td>{{ abs($maintenanceExpense->transaction->amount) }}</td>
                                            <td>{{ $maintenanceExpense->title }}</td>
                                            <td>
                                                <div>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.maintenance-expenses.show', ['estate'=> $estate->id, 'maintenance_expense' => $maintenanceExpense->id]) }}">
                                                        <i class="action-icon fa fa-eye fa-lg m-t-2 "></i>
                                                    </a>
                                                    <a style="margin-left:20px;text-decoration:none"
                                                        href="{{ route('estates.maintenance-expenses.edit', ['estate'=> $estate->id , 'maintenance_expense' => $maintenanceExpense->id]) }}">
                                                        <i class="action-icon action-icon--edit fa fa-pencil fa-lg m-t-2"></i>
                                                    </a>
                                                    <form class="d-inline"
                                                        action="{{ route('estates.maintenance-expenses.destroy', ['estate'=> $estate->id, 'maintenance_expense' => $maintenanceExpense->id, 'estate_id' => $maintenanceExpense->estateId]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <i
                                                            class="delete-expense-btn action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                                        <input class="delete-submit-btn" type="submit" hidden>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        @else
                            <div class="card card-inverse card-primary text-xs-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        لا توجد مصاريف صيانة مسجلة لهذا العقار , قم باضافة مصروف صيانة
                                    </blockquote>
                                </div>
                            </div>

                            <p></p>
                        @endif
                    </div>

                    {{-- botom pagination  --}}
                    @isset($pagination)
                        @if ($pagination->getPageCounts() > 1)
                            <ul class="pagination row">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $pagination->getPreviousPageURL() }}">السابق</a>
                                </li>
                                @foreach ($pagination->getLinks() as $index => $link)
                                    <li class="page-item {{ $pagination->currentPage == $index + 1 ? 'active' : null }}"><a
                                            class="page-link " href="{{ $link }}">{{ $index + 1 }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item"><a class="page-link" href="{{ $pagination->getNextPageURL() }}">التالى</a>
                                </li>
                            </ul>
                        @endif
                    @endisset($pagination)

                </div>

                {{-- botom pagination  --}}
            </div>
        @endisset
        {{-- / estate maintenance expenses  --}}
    </div>
@endsection
