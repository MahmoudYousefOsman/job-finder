<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Applications') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-bordered w-full">
                        <thead>
                        <tr>
                            <th class=" px-4 py-2">Job Title</th>
                            <th class=" px-4 py-2">Applicant Name</th>
                            <th class=" px-4 py-2">Applicant Email</th>
                            <th class=" px-4 py-2">Applicant phone</th>
                            <th class=" px-4 py-2">Applicant status</th>
                            <th class=" px-4 py-2">Applicant Resume</th>
                            <th class=" px-4 py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td class="border px-4 py-2">{{ $job->title }}</td>
                                <td class="border px-4 py-2">{{ $application->name }}</td>
                                <td class="border px-4 py-2">{{ $application->email }}</td>
                                <td class="border px-4 py-2">{{ $application->phone }}</td>
                                <td class="border px-4 py-2">{!! $application->pivot->status->toBadgeTailwind()  !!} </td>
                                <td class="border px-4 py-2">
                                    <a href="{{$application ->pivot->resume_url}}">Resume</a>
                                </td>
                                <td class="border px-4 py-2">
                                    <form method="POST" action="{{ route('employer.jobs.accept', $application->pivot->id) }}">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('employer.jobs.reject',  $application->pivot->id) }}">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
