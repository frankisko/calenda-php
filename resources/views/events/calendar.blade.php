@extends("../base")

@section("title", "Calenda - Calendar")

@section("content")
    <div class="row">
        <div class="col-1">
            <h1>
                <a href="{{ route('events.calendar', [$previous_date->format('Y'), $previous_date->format('m')]) }}">&lt;</a>
            </h1>
        </div>
        <div class="col-10">
            <h1 class="text-center">{{ $month_name }} {{ $year }}</h1>
        </div>
        <div class="col-1">
            <h1>
            <a href="{{ route('events.calendar', [$next_date->format('Y'), $next_date->format('m')]) }}">&gt;</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Sun</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Mon</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Tue</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Wed</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Thu</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Fri</h1>
        </div>
        <div class="card" style="width: 11rem;">
            <h1 class="text-center">Sat</h1>
        </div>
    </div>

    <div class="row">
        @foreach($days_blocks as $block)
            <div class="card" style="width: 11rem; background-color: {{ $block['label'] == date('d') && $month == date('n')? '#FFFF00' : '#FFFFFF' }} ">
                <div class="card-body">
                    <h5 class="card-title">{{ $block["label"] }}</h5>
                    <p class="card-text">
                        @foreach($block['events'] as $event)
                            <a href="{{ route('events.show', $event->id_event) }}" class="card-link" >
                                <span class="badge" style="background-color: {{ $event->type->color }}">{{ $event["name"] }}</span>
                            </a>
                        @endforeach
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection