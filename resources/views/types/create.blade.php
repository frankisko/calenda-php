@extends("../base")

@section("title", "Calenda - Create type")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Create Type</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('types.store') }}" method="POST">
               <x-type-form-body/>
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