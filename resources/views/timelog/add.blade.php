<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Add Time</h3>
                </div>
                <hr>
                <div class="container mt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('timelog.store') }}" method="post">
                        @csrf
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">Project:</div>
                            <div class="col-6">
                                <select name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            @if (old('project_id') == $project->id) selected @endif>
                                            {{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">Date:</div>
                            <div class="col-6">
                                <input type="date" name="work_date" value="{{ old('work_date') }}">
                            </div>
                        </div>
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">Start Time:</div>
                            <div class="col-6">
                                <input type="time" name="start_time" value="{{ old('start_time') }}">
                            </div>
                        </div>
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">End Time:</div>
                            <div class="col-6">
                                <input type="time" name="end_time" value="{{ old('end_time') }}">
                            </div>
                        </div>
                        <div class="text-center mb-3 justify-content-center">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
