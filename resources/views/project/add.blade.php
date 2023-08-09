<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Add Project</h3>
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
                    <form action="{{ route('project.store') }}" method="post">
                        @csrf
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">Project Name:</div>
                            <div class="col-6"><input class="form-control" type="text" name="project_name"
                                    value="{{ old('project_name') }}" /></div>
                        </div>
                        <div class="mb-3 row justify-content-center">
                            <div class="col-3">Project Description:</div>
                            <div class="col-6">
                                <textarea class="form-control" name="project_description">{{ old('project_description') }}</textarea>
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
