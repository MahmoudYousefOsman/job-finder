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

        .panel-title>small {
            font-size: .75em;
            color: #999999;
        }

        .panel-body *:first-child {
            margin-top: 0;
        }

        .panel-footer {
            border-top: 0;
        }

        .panel-default>.panel-heading {
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
        <div class="row">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="{{ route('profile') }}" @class([
                        'active' => Route::currentRouteNamed('profile'),
                        'list-group-item list-group-item-action',
                    ])>User
                        Management</a>
                    <a href="{{ route('applications') }}" @class([
                        'active' => Route::currentRouteNamed('applications'),
                        'list-group-item list-group-item-action',
                    ])>Applications</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Your Applications</h4>
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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($applications as $application)
                                    @php($job = $application->job)
                                    <div class="single-job-items mb-30">
                                        <div class="job-items">
                                            <div class="company-img">
                                                <a href="#"><img
                                                        src="{{ $job->employer->image ? $job->employer->image_url : '/assets/img/icon/job-list1.png' }}"
                                                        style="height: 100px; width:100px;" alt=""></a>
                                            </div>
                                            <div class="job-tittle job-tittle2">
                                                <a href="#">
                                                    <h4>{{ $job->title }}</h4>
                                                </a>
                                                <ul>
                                                    <li>{{ $job->employer->name }}</li>
                                                    <li>
                                                        <i
                                                            class="fas fa-map-marker-alt"></i>{{ Str::limit($job->location, 20) }}
                                                    </li>
                                                    <li>${{ $job->salary_start }}</li>
                                                </ul>
                                                <ul>
                                                    <li>{!! $application->status->toBadge() !!}</li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="items-link items-link2 f-right">
                                            <a href="{{ route('job', $job) }}">show</a>
                                            <form id="form-cancel" action="{{ route('job.cancel', $job) }}" method="post">
                                                @method('PATCH')
                                                @csrf
                                            </form>
                                            <a class=" text-danger border-danger" role="button"
                                                onclick="confirmDeleting()">cancel</a>
                                            <span>{{ $application->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function confirmDeleting() {

            if (!confirm('Are you Sure !!?')) {
                return;
            }

            document.getElementById('form-cancel').submit()
        }
    </script>
@endpush
