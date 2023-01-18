@extends("../base")

@section("title", "Calenda - Show event")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">{{ $event->name }}</h1>
        </div>
    </div>
    <div class="row">
        <ul>
            <li><b>Id:</b> {{ $event->id_event }}</li>
            <li><b>Description:</b> {{ $event->description }}</li>
            <li><b>Date:</b> {{ $event->date->format("Y-m-d") }}</li>
            <li><b>Type:</b> {{ $event->type->name }}</li>

        </ul>
    </div>
@endsection