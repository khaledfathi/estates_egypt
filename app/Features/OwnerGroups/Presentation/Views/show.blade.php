@extends('shared::main-layout')
@section('title', 'مجموعة الملاك | عرض مجموعة ')
@section('active-owners', 'active')
@section('styles')
    @vite('resources/css/features/owners/show.css')
@endsection
@section('scripts')
    @vite('resources/ts/features/owner-groups/show.ts')
@endsection

@section('content')
    <div class="container-fluid ">

        {{-- Errors --}}
        @if ($errors->any() || isset($error))
            <div class="row" style="display:flex; justify-content:center;">
                <div class="col-sm-12 col-md-10 col-lg-8">
                    <div class="card card-inverse card-danger ">
                        <div class="card-block">
                            <ul>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @elseif (isset($error))
                                    <li>{{ $error }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- / Errors --}}

        @isset($ownerGroup)
            <div class="container-fluid">
                <a href="{{ route('owner-groups.index') }}" class="btn btn-md btn-primary my-5">
                    <i class="fa fa-users fa-lg d-inline-block"></i>
                    <span> المجموعات </span>
                </a>
                <a href="{{ route('owners.index') }}" class="btn btn-md btn-primary my-5">
                    <i class="icon-people fa-lg d-inline-block"></i>
                    <span> الملاك </span>
                </a>
                <div class="row" style="display:flex; justify-content: center;">
                    <div id="" class="col-sm-12 col-md-10 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>بيانات المجموعة</strong>
                            </div>
                            <div class="card-block">
                                <ul>
                                    <li>اسم المجموعة : {{ $ownerGroup->name }}</li>
                                    <li>عدد الاعضاء : {{ $ownerGroup->ownersCount}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- owners  list  --}}
            @if (count($ownerGroup->owners))
                <hr>
                <div class ="container-fluid ">
                    <h5 style="text-align:center">قائمة اعضاء المجموعة</h5>
                    <div class="card-block">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>اسم المالك</th>
                                    <th>الرقم القومى</th>
                                    <th>تليفون</th>
                                    <th width="10%">صفحة المالك</th>
                                    <th width="10%">حذف من المجموعة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ownerGroup->owners as $owner)
                                    <tr>
                                        <td>{{ $owner->name }}</td>
                                        <td>{{ $owner->nationalId ?? '----' }}</td>
                                        <td>
                                            @if (!count($owner->phones))
                                                ----
                                            @else
                                                @foreach ($owner->phones as $phone)
                                                    {{ $phone }}<br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td><a href="{{ route('owners.show', $owner->id) }}" >
                                                <i class="action-icon fa fa-external-link fa-lg m-t-2"></i>
                                            </a></td>
                                        <td>
                                            <form action="{{ route('owner-groups.unlink' , ['owner_group'=> $ownerGroupId , 'owner_in_group'=>$owner->ownerInGroup->id ])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i class="delete-owner-btn action-icon action-icon--delete fa fa-chain-broken fa-lg m-t-2"></i>
                                                <input class="delete-submit-btn" type="submit" hidden="">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            {{-- / owners  list  --}}
        @endisset
    </div>
@endsection
