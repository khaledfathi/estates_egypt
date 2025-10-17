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
            {{-- header buttons section --}}
            <div class="container">
                <a href="{{ route('owners.index') }}" class="btn btn-md btn-secondary my-5">
                    <i class="icon-people fa-lg d-inline-block"></i>
                    <span>الملاك</span>
                </a>
                <a href="{{ route('owner-groups.index') }}" class="btn btn-md btn-secondary my-5">
                    <i class="fa fa-users fa-lg d-inline-block"></i>
                    <span>المجموعات</span>
                </a>
            </div>
            <hr>
            {{-- / header buttons section --}}

            <div class="container-fluid">
                <div class="row" style="display:flex; justify-content: center;">
                    <div id="" class="col-sm-12 col-md-10 col-lg-6">
                        <div class="card">
                            <div class="edit-box-header">
                                <strong>بيانات المالك</strong>
                                <div>
                                    <a style="margin-left:10px;text-decoration:none"
                                        href="{{ route('owner-groups.edit', $ownerGroup->id) }}">
                                        <i class="action-icon action-icon--edit fa fa-pencil fa-lg "></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('owner-groups.destroy', $ownerGroup->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <i id="delete-owner-btn"
                                            class="action-icon action-icon--delete fa fa-trash fa-lg m-t-2"></i>
                                        <input id="delete-owner-submit-btn" type="submit" hidden>
                                    </form>
                                </div>
                            </div>
                            <div class="card-block">
                                <ul>
                                    <li>اسم المجموعة : {{ $ownerGroup->name }}</li>
                                    <li>عدد الاعضاء : {{ $ownerGroup->ownersCount }}</li>
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
                                        <td><a href="{{ route('owners.show', $owner->id) }}">
                                                <i class="action-icon fa fa-external-link fa-lg m-t-2"></i>
                                            </a></td>
                                        <td>
                                            <form
                                                action="{{ route('owner-groups.unlink', ['owner_group' => $ownerGroupId, 'owner_in_group' => $owner->ownerInGroup->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i
                                                    class="delete-owner-btn action-icon action-icon--delete fa fa-chain-broken fa-lg m-t-2"></i>
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
