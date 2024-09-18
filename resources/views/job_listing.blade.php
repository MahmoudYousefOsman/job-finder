@php use App\Enums\WorkTypeEnum; @endphp
@php use App\Enums\ExperienceLevelEnum; @endphp
@extends('layouts.web.app')
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="{{ assert('assets') }}/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Get your job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <form class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                                <div class="ion">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="12px">
                                        <path fill-rule="evenodd" fill="rgb(27, 207, 107)"
                                            d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                                    </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->

                    <div class="job-category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Job Category</h4>
                            </div>
                            <!-- Select job items start -->
                            <div class="select-job-items2">
                                <select name="category_id">
                                    <option value="">All Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Job Type</h4>
                                </div>

                                <label class="container">all
                                    <input type="radio" name="work_type" value="0" @checked(request('work_type', 0) == 0)>
                                    <span class="checkmark"></span>
                                </label>
                                @foreach (WorkTypeEnum::cases() as $type)
                                    <label class="container">{{ $type->toString() }}
                                        <input type="radio" name="work_type" value="{{ $type->value }}"
                                            @checked(request('work_type', 0) == $type->value)>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <!-- single two -->
                        <div class="single-listing">
                            <div class="small-section-tittle2">
                                <h4>Job Location</h4>
                            </div>
                            <!-- Select job items start -->
                            <div class="select-job-items2">
                                <input type="text" class="form-control" value="{{ request('location') }}"
                                    name="location">
                            </div>
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Experience</h4>
                                </div>
                                <label class="container">All
                                    <input type="radio" name="experience_level" value="0"
                                        @checked(request('experience_level', 0) == 0)>
                                    <span class="checkmark"></span>
                                </label>
                                @foreach (ExperienceLevelEnum::cases() as $experience)
                                    <label class="container">{{ $experience->toString()->ucfirst() }}
                                        <input type="radio" name="experience_level" value="{{ $experience->value }}"
                                            @checked(request('experience_level', 0) == $experience->value)>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach

                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <!-- single three -->
                        <div class="single-listing">
                            <!-- select-Categories start -->
                            <div class="select-Categories pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Posted Within</h4>
                                </div>
                                <label class="container">Any
                                    <input type="radio" name="created_at" value="0" @checked(!request('created_at'))>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Today
                                    <input type="radio" name="created_at" value="{{ today() }}"
                                        @checked(request('created_at') == today())>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 2 days
                                    <input type="radio" name="created_at" value="{{ today()->subDays(2) }}"
                                        @checked(request('created_at') == today()->subDays(2))>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 3 days
                                    <input type="radio" name="created_at" value="{{ today()->subDays(3) }}"
                                        @checked(request('created_at') == today()->subDays(3))>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 5 days
                                    <input type="radio" name="created_at" value="{{ today()->subDays(5) }}"
                                        @checked(request('created_at') == today()->subDays(5))>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 10 days
                                    <input type="radio" name="created_at" value="{{ today()->subDays(10) }}"
                                        @checked(request('created_at') == today()->subDays(10))>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <div class="single-listing">
                            <!-- Range Slider Start -->
                            <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                <div class="small-section-tittle2">
                                    <h4>Filter Jobs</h4>
                                </div>
                                <div class="widgets_inner">
                                    <div class="range_item">
                                        <!-- <div id="slider-range"></div> -->
                                        <input type="text" class="js-range-slider" value="" />
                                        <div class="d-flex align-items-center">
                                            <div class="price_text">
                                                <p>Price :</p>
                                            </div>
                                            <div class="price_value d-flex justify-content-center">
                                                <input type="text" class="js-input-from" id="amount" readonly />
                                                <span>to</span>
                                                <input type="text" class="js-input-to" id="amount" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <!-- Range Slider End -->
                        </div>
                    </div>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <div class="d-flex p-0 form-control mb-3">
                                            <input type="search" placeholder="search by title, description "
                                                value="{{ request('search') }} " name="search"
                                                class="flex-grow-1 px-2 py-1"
                                                style="outline: none;border: none ;max-height: 100%">
                                            <button class="btn btn-primary btn-sm p-0 px-2" style="max-height: 100%"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                        <!-- Select job items start -->
                                        <div class="select-job-items">
                                            <span>Sort by</span>
                                            <select name="select">
                                                <option value="">None</option>
                                                <option value="">job list</option>
                                                <option value="">job list</option>
                                                <option value="">job list</option>
                                            </select>
                                        </div>
                                        <!--  Select job items End-->
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            @foreach ($jobs as $job)
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="#"><img
                                                    src="{{ $job->employer->image ? $job->employer->image_url : asset('assets') . '/img/icon/job-list1.png' }}"
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
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                        <a href="{{ route('job', $job) }}">show</a>
                                        <span>{{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </form>
        </div>
        <!--Pagination Start  -->
        <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">

                        <div class="single-wrap d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pagination End  -->
    </div>
    <!-- Job List Area End -->
@endsection
@push('js')
    <script>
        $(function() {

            var $range = $(".js-range-slider"),
                $inputFrom = $(".js-input-from"),
                $inputTo = $(".js-input-to"),
                instance,
                min = 0,
                max = 100000,
                from = 1000,
                to = 10000;

            $range.ionRangeSlider({
                type: "double",
                min: min,
                max: max,
                from: from,
                to: to,
                prefix: 'tk. ',
                onStart: updateInputs,
                onChange: updateInputs,
                step: 1,
                prettify_enabled: true,
                prettify_separator: ".",
                values_separator: " - ",
                force_edges: true


            });

            instance = $range.data("ionRangeSlider");

            function updateInputs(data) {
                from = data.from;
                to = data.to;

                $inputFrom.prop("value", from);
                $inputTo.prop("value", to);
            }

            $inputFrom.on("input", function() {
                var val = $(this).prop("value");

                // validate
                if (val < min) {
                    val = min;
                } else if (val > to) {
                    val = to;
                }

                instance.update({
                    from: val
                });
            });

            $inputTo.on("input", function() {
                var val = $(this).prop("value");

                // validate
                if (val < from) {
                    val = from;
                } else if (val > max) {
                    val = max;
                }

                instance.update({
                    to: val
                });
            });

        });
    </script>
@endpush
