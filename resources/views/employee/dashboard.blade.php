<x-app-layout>
    <div class="container md:mx-auto">
        <div class="m-10 w-screen mx-auto max-w-screen-md">
            <div class="flex flex-col">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
                    <form class="">
                        <div class="relative mb-10 w-full flex  items-center justify-between rounded-md">
                            <svg class="absolute left-2 block h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" class=""></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65" class=""></line>
                            </svg>
                            <input type="name" name="search"
                                   value="{{request('search')}}"
                                   class="h-12 w-full cursor-text rounded-md border border-gray-100 bg-gray-100 py-4 pr-40 pl-12 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   placeholder="Search by title, description, location, etc"/>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div class="flex flex-col">
                                <select id="manufacturer"
                                        name="category_id"
                                        class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Chose Category</option>
                                    @foreach($categories as $category)
                                        <option @selected(request('category_id', ) == $category->id) value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <select id="status"
                                        name="skill_id"
                                        class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Chose Skill</option>
                                    @foreach($skills as $skill)
                                        <option @selected(request('skill_id', ) == $skill->name) value="{{$skill->name}}">{{$skill->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <input type="number" id="salary_form" name="salary_form" placeholder="Salary From"
                                       value="{{request('salary_form')}}"
                                       class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </div>
                            <div class="flex flex-col">
                                <input type="number"
                                       value="{{request('salary_to')}}"
                                       id="salary_to" name="salary_to" placeholder="Salary To"
                                       class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-col">
                                    <select id="created_at"
                                            class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        name="created_at"
                                    >
                                        <option value="">Created At</option>
                                        <option value="{{today()}}">Today</option>
                                        <option value="{{today()->subWeek()}}">Last Week</option>
                                        <option value="{{today()->subMonth()}}">Last Month</option>

                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                            <button
                                class="rounded-lg bg-gray-200 px-8 py-2 font-medium text-gray-700 outline-none hover:opacity-80 focus:ring">
                                Reset
                            </button>
                            <button
                                class="rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none hover:opacity-80 focus:ring">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            @foreach($jobs as $job)

                <a href="#"
                   class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                         src="/docs/images/blog/image-4.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$job->title}}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$job->description}}</p>
                        <span>{{$job->location}}</span>
                        <span>{{$job->work_type->toString()}}</span>
                        <span>
                                @if($job->applications_count <  15)
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$job->applications_count}}</span>
                            @elseif($job->applications_count <  50)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{$job->applications_count}}</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{$job->applications_count}}</span>
                            @endif
                                Applicant
                            </span>
                    </div>
                </a>

            @endforeach
        </div>
        <div class="my-3">
            {{$jobs->links()}}

        </div>
    </div>
</x-app-layout>
