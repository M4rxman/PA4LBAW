@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @auth
        <div class="container">
            <div class="text-center mt-5">
                <h1>Welcome back, {{ Auth::user()->name }}!</h1>
                <p>Here’s an overview of your active projects and tasks.</p>
            </div>

            <!-- Projects Section -->
            <div class="projects-container">
                <div class="favorite-projects">
                    <h2>Favorite Projects</h2>
                    @if($favoriteProjects->isEmpty())
                        <p>You don't have any favorite projects yet.</p>
                    @else
                        @foreach($favoriteProjects as $favorite)
                            <div class="favorite-project">
                                <span class="star-icon">⭐</span>
                                <h3>
                                <a href="{{ route('projectDetails', ['id' => $favorite->project->projectId]) }}" class="nav-link">
                                        {{ $favorite->project->name }}
                                    </a>
                                </h3>
                                <p>Status: Ongoing</p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="my-projects">
                    <h2>My Projects</h2>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
                    @if($myProjects->isEmpty())
                        <p>You don't have any projects yet.</p>
                    @else
                        @foreach($myProjects as $project)
                            <div class="my-project">
                                <a href="{{ route('projects.show', ['id' => $project->projectid]) }}" class="nav-link">
                                        <h3>{{ $project->name }}</h3>
                                </a>
                                <p class="small mb-0">{{ $project->description }}</p>
                                <p class="small text-muted">Status: {{ $project->endDate ? 'Completed' : 'In Progress' }}</p>
                            </div>
                       @endforeach
                    @endif
                </div>
            </div>

            <!-- Upcoming Tasks Section -->
            <div class="upcoming-tasks">
                <h2>Upcoming Tasks</h2>
                @if($upcomingTasks->isEmpty())
                    <p>No upcoming tasks.</p>
                @else
                    @foreach($upcomingTasks as $task)
                        <div class="task">
                            <div class="task-title">
                                <a href="{{ route('tasks.show', ['id' => $task->taskid]) }}" class="nav-link">
                                    {{ $task->title }}
                                </a>
                            </div>
                            <p>{{ $task->project->name }}</p>
                            <p>{{ $task->description }}</p>
                            <p class="task-meta">Due: {{ $task->duedate }}</p>
                            <p class="task-meta">Priority: {{ ucfirst($task->priority) }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @else
        <div class="container text-center mt-5">
            <p>Please log in to access your projects.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
    @endauth
</body>
</html>
@endsection
