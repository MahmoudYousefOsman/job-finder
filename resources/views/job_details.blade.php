@extends('layouts.web.app')
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('/') }}assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $job->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" action="{{ route('apply', $job) }}"}} method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Apply to {{ $job->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="">
                            CV
                        </label>
                        <input accept="application/pdf" class="form-control" name="cv" type="file">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            @if (session('success'))
                <div class="alert-success alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50">
                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <a href="#">
                                    <img src="{{ $job->employer->image ? $job->employer->image_url : asset('assets') . '/img/icon/job-list1.png' }}"
                                        style="height: 100px; width:100px;" alt="">
                                </a>
                            </div>
                            <div class="job-tittle">
                                <a href="#">
                                    <h4>{{ $job->title }}</h4>
                                </a>
                                <ul>
                                    <li>{{ $job->employer->name }}</li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $job->location }}
                                    </li>
                                    <li>${{ $job->salary_start }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p>{{ $job->description }}</p>
                        </div>
                        <div class="post-details2  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Required Knowledge, Skills, and Abilities</h4>
                            </div>
                            <ul>
                                @foreach ($job->skills as $skill)
                                    <li>{{ $skill->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span>{{ $job->created_at->format('d M Y') }}</span></li>
                            <li>Location : <span>{{ str($job->location)->limit(20) }}</span></li>
                            <li>Job nature : <span>{{ $job->work_type->toString() }}</span></li>
                            <li>Salary : <span>${{ $job->salary_start }} / Mouth</span></li>
                            <li>Application date : <span>{{ $job->expired_at->format('d M Y') }}</span></li>
                        </ul>
                        @if (
                            !auth()->user()
                                ?->type->is(\App\Enums\UserTypeEnum::Employer))
                            <div class="apply-btn2">
                                <button data-toggle="modal" data-target="#exampleModalLong" class="btn">Apply
                                    Now</button>
                            </div>
                        @endif
                    </div>
                    <div class="post-details4  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Company Information</h4>
                        </div>
                        <span>{{ $job->employer->name }}</span>
                        <ul>
                            <li>Name: <span>{{ $job->employer->name }} </span></li>
                            <li>Email: <span>{{ $job->employer->email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->
@endsection
