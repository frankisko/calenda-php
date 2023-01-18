@extends("../base")

@section("title", "Calenda - Edit event")

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Edit Event: {{ $event->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @method('put')
                <x-event-form-body :event="$event" :types="$types"/>
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

@section("scripts_footer")
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            })
        });
    </script>
@endsection