@extends("../base")

@section("title", "Calenda - Show type")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">{{ $type->name }}</h1>
        </div>
    </div>
    <div class="row">
        <ul>
            <li><b>Id:</b> {{ $type->id_type }}</li>
            <li><b>Color:</b> {{ $type->color }}</li>
            <li><b>Duration:</b> {{ $type->duration() }}</li>
        </ul>
    </div>
@endsection