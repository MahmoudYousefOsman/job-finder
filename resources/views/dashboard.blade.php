@php use App\Models\Skill; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex justify-between items-center overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    My Jobs
                </div>
                <div class="flex justify-center items-center">
                    <a
                        href="{{route('employer.jobs.create')}}"
                        type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                        <i class="fas fa-plus"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div> {{session('success')}}</div>
                </div>
            </div>
        </div>
    @endif
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid gap-2 grid-cols-3">
                    @foreach($jobs as $job)
                        <div class="bg-gray-50 flex flex-col justify-center relative overflow-hidden">
                            <div class="">
                                <div class="relative group">
                                    <div
                                        class="absolute -inset-1  rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                                    <div
                                        class="relative px-7 py-6 bg-white ring-1 ring-gray-900/5 rounded-lg leading-none flex w-100 items-top justify-start space-x-6">
                                        <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="1.5"
                                                  d="M6.75 6.75C6.75 5.64543 7.64543 4.75 8.75 4.75H15.25C16.3546 4.75 17.25 5.64543 17.25 6.75V19.25L12 14.75L6.75 19.25V6.75Z"></path>
                                        </svg>
                                        <div class="space-y-2 w-100 grow">
                                            <div class="flex justify-between w-100 items-center">
                                                <span class="text-slate-800">{{$job->title}}</span>
                                            </div>
                                            <div class="flex justify-between w-100 items-center">
                                                <span class="text-slate-800">{{$job->skills->implode(fn(Skill $skill) => $skill->name,',')}}</span>
                                            </div>

                                            <div class="text-slate-800">
                                                @if(!$job->isExpired())
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Active</span>
                                                @else
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Expired</span>
                                                @endif
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$job->applications_count}} Application</span>
                                            </div>

                                            <div class="flex gap-2" style="margin-top: 25px !important;">

                                                <a
                                                    href="{{route('job',$job)}}"
                                                    type="button"
                                                    target="_blank"
                                                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a
                                                    href="{{route('employer.jobs.edit', $job)}}"
                                                    role="button"
                                                    class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a
                                                    href="{{route('employer.jobs.applications', $job)}}"
                                                    role="button"
                                                    class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2"
                                                    title="Edit"
                                                >
                                                    <i class="fas fa-list"></i>
                                                </a>

                                                <form class="hidden" action="{{route('employer.jobs.destroy',$job)}}"
                                                      method="post" id="delete-job-{{$job->id}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                <a
                                                    role="button"
                                                    onclick="destroy('delete-job-{{$job->id}}')"
                                                    href="javascript:void(0)"
                                                    class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </a>




                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{$jobs->links()}}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            function destroy(id) {
                if (!confirm('Are you sure ?!')) {
                    return;
                }
                document.getElementById(id).submit();
            }
        </script>
    @endpush
</x-app-layout>

