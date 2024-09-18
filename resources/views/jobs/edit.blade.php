@php use App\Enums\ExperienceLevelEnum;use App\Enums\WorkTypeEnum; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('employer.jobs.update', $job) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Job Title -->
                        <div>
                            <x-input-label for="title" :value="__('Job Title')"/>

                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                          value="{{ old('title', $job->title) }}" required autofocus/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>

                        <!-- Job Work Type -->
                        <div class="mt-4">
                            <x-input-label for="work_type" :value="__('Work Type')"/>

                            <select name="work_type" id="work_type"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach (WorkTypeEnum::cases() as $type)
                                    <option
                                        value="{{ $type->value }}" {{ old('work_type', $job->work_type->value) == $type->value ? 'selected' : '' }}>{{ $type->toString() }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('work_type')" class="mt-2"/>
                        </div>
                        <!-- Job Experience Level -->
                        <div class="mt-4">
                            <x-input-label for="experience_level" :value="__('Experience Level')"/>


                            <select name="experience_leve" id="experience_level"

                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach (ExperienceLevelEnum::cases() as $level)
                                    <option
                                        value="{{ $level->value }}" {{ old('experience_level', $job->experience_leve->value) == $level->value ? 'selected' : '' }}>{{ $level->toString() }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('experience_level')" class="mt-2"/>
                        </div>
                        <!-- Job Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Job Description')"/>

                            <textarea id="description" class="block mt-1 w-full" name="description"
                                      required>{{ old('description', $job->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                        </div>
                        <!-- Job Expired At -->
                        <div class="mt-4">
                            <x-input-label for="expired_at" :value="__('Expired at')"/>
                            <x-text-input id="expired_at" class="block mt-1 w-full" type="date" name="expired_at"
                                          value="{{ old('expired_at', $job->expired_at->format('Y-m-d')) }}" required/>
                            <x-input-error :messages="$errors->get('expired_at')" class="mt-2"/>
                        </div>
                        <!-- Job Requirements -->
                        <div class="mt-4">
                            <x-input-label for="responsibilities" :value="__('Job responsibilities')"/>
                            <textarea id="requirements" class="block mt-1 w-full" name="responsibilities"
                                      required>{{ old('responsibilities', $job->responsibilities) }}</textarea>
                            <x-input-error :messages="$errors->get('responsibilities')" class="mt-2"/>
                        </div>

                        <!-- Job Category -->
                        <div class="mt-4">
                            <x-input-label for="category" :value="__('Job Category')"/>

                            <select name="category_id" id="category_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                        </div>

                        <!-- Job Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Job Location')"/>

                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                                          value="{{ old('location', $job->location) }}" required/>
                            <x-input-error :messages="$errors->get('location')" class="mt-2"/>
                        </div>

                        <!-- Job Salary -->
                        <div class="mt-4">
                            <x-input-label for="salary" :value="__('Job Salary')"/>

                            <x-text-input id="salary" class="block mt-1 w-full" type="text" name="salary_start"
                                          value="{{ old('salary_start', $job->salary_start) }}" required/>
                            <x-input-error :messages="$errors->get('salary_start')" class="mt-2"/>
                        </div>

                        <!-- Job Tags -->
                        <div class="mt-4">
                            <x-input-label for="tags" :value="__('Job skills')"/>

                            <x-text-input id="tags" class="block mt-1 w-full" type="text" name="skills"
                                          value="{{ old('skills', $job->skills->implode(fn($x) => $x->name,',')) }}"
                                          required/>
                            <x-input-error :messages="$errors->get('skills')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Job') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
