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
                    <a href="{{ route('timelog.create') }}" class="btn btn-primary">Add Time Log</a>
                </div>

                <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $chart->container() !!}
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mx-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-2">
                            Project:
                        </div>
                        <div class="3">
                            <select name="project_id" id="project" onchange="projectChanged()">
                                <option value="all">All</option>
                                @forelse ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>

                <table class="m-3 mt-5 table">
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Hours</th>
                        <th>Actions</th>
                    </tr>
                    @forelse ($timelogs as $timelog)
                        @php
                            // Calculation of hours
                            $start = new DateTime($timelog->start_time);
                            $end = new DateTime($timelog->end_time);
                            $hours = $start->diff($end);
                        @endphp
                        <tr>
                            <td>{{ $timelog->id }}</td>
                            <td>{{ $timelog->project->project_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($timelog->work_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($timelog->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($timelog->end_time)->format('H:i') }}</td>
                            <td>{{ $hours->h }}</td>
                            <td><a href="{{ route('timelog.edit', ['id' => $timelog->id]) }}"
                                    class="btn btn-link">Edit</a>
                                <a href="{{ route('timelog.destroy', ['id' => $timelog->id]) }}"
                                    class="btn btn-link ml-3 text-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='7'>No timelogs found!!!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}

    <script>
        function projectChanged() {
            var sel = document.getElementById('project');
            var projectId = sel.value;
            var url = "{{ route('timelog.filter', ['project_id' => ':id']) }}";
            url = url.replace(':id', projectId);
            document.location.href=url;
        }
    </script>

</x-app-layout>
