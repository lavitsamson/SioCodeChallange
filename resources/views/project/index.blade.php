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
                    <a href="{{ route('project.create') }}" class="btn btn-primary">Add Project</a>
                </div>

                <table class="m-3 mt-5 table">
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->project_name }}</td>
                            <td>{{ $project->project_description }}</td>
                            <td><a href="{{ route('project.edit', ['id' => $project->id]) }}"
                                    class="btn btn-link">Edit</a>
                                <a href="{{ route('project.destroy', ['id' => $project->id]) }}"
                                    class="btn btn-link ml-3 text-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='4'>No projects found!!!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
