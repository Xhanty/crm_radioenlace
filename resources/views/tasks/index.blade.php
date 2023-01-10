@extends('layouts.board')

@section('content')
<div class="md:mx-4 relative overflow-hidden">
    <main class="h-full flex flex-col overflow-auto">
        <kanban-board :initial-data="{{ $tasks }}" :admin-data="{{ $is_admin }}"></kanban-board>
    </main>
</div>
@endsection