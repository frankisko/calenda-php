@extends("../base")

@section("title", "Calenda - Edit type")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Edit Type: {{ $type->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('types.update', $type) }}" method="POST">
                @method('put')
                <x-type-form-body :type="$type"/>
            </form>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection