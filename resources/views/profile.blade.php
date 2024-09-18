@extends('layouts.web.app')
@push('css')
    <style>
        body {
            margin-top: 20px;
            background: #f5f5f5;
        }

        /**
         * Panels
         */
        /*** General styles ***/
        .panel {
            box-shadow: none;
        }

        .panel-heading {
            border-bottom: 0;
        }

        .panel-title {
            font-size: 17px;
        }

        .panel-title > small {
            font-size: .75em;
            color: #999999;
        }

        .panel-body *:first-child {
            margin-top: 0;
        }

        .panel-footer {
            border-top: 0;
        }

        .panel-default > .panel-heading {
            color: #333333;
            background-color: transparent;
            border-color: rgba(0, 0, 0, 0.07);
        }

        form label {
            color: #999999;
            font-weight: 400;
        }

        .form-horizontal .form-group {
            margin-left: -15px;
            margin-right: -15px;
        }

        @media (min-width: 768px) {
            .form-horizontal .control-label {
                text-align: right;
                margin-bottom: 0;
                padding-top: 7px;
            }
        }

        .profile__contact-info-icon {
            float: left;
            font-size: 18px;
            color: #999999;
        }

        .profile__contact-info-body {
            overflow: hidden;
            padding-left: 20px;
            color: #999999;
        }

        .profile-avatar {
            width: 200px;
            position: relative;
            margin: 0px auto;
            margin-top: 196px;
            border: 4px solid #f3f3f3;
        }
    </style>
@endpush
@section('content')
    <div class="container pt-50 pb-50">
        <div class="row " style="height: 70vh;">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="{{route('profile')}}" @class(['active' => Route::currentRouteNamed('profile') ,'list-group-item list-group-item-action'])>User
                        Management</a>
                    <a href="{{route('applications')}}" @class(['active' => Route::currentRouteNamed('applications') ,'list-group-item list-group-item-action'])>Applications</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Your Profile</h4>
                                <hr>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <form enctype="multipart/form-data" method="post" action="{{route('profile.update')}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="username" class="col-4 col-form-label">Name*</label>
                                        <div class="col-8">
                                            <input id="name" name="name" placeholder="name"
                                                   value="{{auth()->user()->name}}"
                                                   class="form-control here" required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email*</label>
                                        <div class="col-8">
                                            <input id="email" name="email" placeholder="Email" class="form-control here"
                                                   value="{{auth()->user()->email}}"
                                                   required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-4 col-form-label">Phone*</label>
                                        <div class="col-8">
                                            <input id="phone" name="phone" placeholder="Email" class="form-control here"
                                                   value="{{auth()->user()->phone}}"
                                                   required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Image</label>
                                        <div class="col-8">
                                            <input
                                                id="file"
                                                accept="image/*"
                                                name="image"
                                                class="form-control here"
                                                type="file"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpass" class="col-4 col-form-label">New Password</label>
                                        <div class="col-8">
                                            <input id="newpass" name="password" placeholder="New Password"
                                                   class="form-control here" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="newpass" class="col-4 col-form-label">New Password
                                            Confirmation</label>
                                        <div class="col-8">
                                            <input id="newpass" name="password_confirmation"
                                                   placeholder="New Password Confirmation"
                                                   class="form-control here" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary">Update My
                                                Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
