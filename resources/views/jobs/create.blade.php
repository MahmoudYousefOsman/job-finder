@php use App\Enums\WorkTypeEnum; @endphp
@php use App\Enums\ExperienceLevelEnum; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="mb-4">
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('employer.jobs.store') }}">
                        @csrf

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                              :value="old('title')" required autofocus/>
                                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="company" :value="__('Salary')"/>
                                <x-text-input id="company" class="block mt-1 w-full" type="number" name="salary_start"
                                              :value="old('salary_start')" required/>
                                <x-input-error :messages="$errors->get('salary_start')" class="mt-2"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="expired_at" :value="__('Expired at')"/>
                                <x-text-input id="expired_at" class="block mt-1 w-full" type="date" name="expired_at"
                                              :value="old('expired_at')" required/>
                                <x-input-error :messages="$errors->get('expired_at')" class="mt-2"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="description" class="block mt-1 w-full" name="description"
                                          required></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="responsibilities" :value="__('Responsibilities')"/>
                                <textarea id="responsibilities" class="block mt-1 w-full" name="responsibilities"
                                          required></textarea>
                                <x-input-error :messages="$errors->get('responsibilities')" class="mt-2"/>
                            </div>
                            <div>
                                <x-input-label for="location" :value="__('Location')"/>
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                                              :value="old('location')" required/>
                                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
                            </div>
                            <div>
                                <x-input-label for="skills" :value="__('Skills')"/>
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="skills"
                                              :value="old('skill')" required placeholder="s1 , s2 etc..."/>
                                <x-input-error :messages="$errors->get('skills')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Category')"/>
                                <select id="category" name="category_id"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="type" :value="__('Type')"/>
                                <select id="type" name="work_type"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach(WorkTypeEnum::cases() as $type)
                                        <option
                                            value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>{{ $type->toString() }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('work_type')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="experience_level" :value="__('Experience Level')"/>
                                <select id="experience_leve" name="experience_leve"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach(ExperienceLevelEnum::cases() as $level)
                                        <option
                                            value="{{ $level->value }}" {{ old('experience_leve') == $level->value ? 'selected' : '' }}>{{ $level->toString() }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('experience_leve')" class="mt-2"/>
                            </div>

                        </div>
                        <div class="mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
