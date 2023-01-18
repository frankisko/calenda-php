<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Type;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('type')
                       ->where("status", "A")
                       ->orderByDesc("id_event")->get();

        $params = [
            "events" => $events
        ];

        return view("events.index", $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::where("status", "A")
                     ->orderBy("name")->get();

        $params = [
            "event"  => Event::make([
                "date" => Carbon::now()
            ]),
            "types"  => $types,
        ];

        return view("events.create", $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $event = Event::create($data);

        return redirect()->route("events.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $params = [
            "event" => $event
        ];

        return view("events.show", $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $types = Type::where("status", "A")
                     ->orderBy("name")->get();

        $params = [
            "event" => $event,
            "types" => $types,
        ];

        return view("events.edit", $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($data);

        return redirect()->route("events.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->update([
            "status" => "I"
        ]);

        return redirect()->route("events.index");
    }

    /**
     * Display calendar
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar($year, $month)
    {
        $current_date  = Carbon::parse($year ."-".$month."-01");
        $previous_date = Carbon::parse($current_date->copy()->subMonth());
        $next_date     = Carbon::parse($current_date->copy()->addMonth());

        $events = Event::with("type")
                       ->where("status", "A")
                       ->whereBetween("date", [$current_date->copy()->startOfMonth()->format("Y-m-d"), $current_date->copy()->endOfMonth()->format("Y-m-d")])
                       ->get();

        //group events by day
        $group_day_events = [];

        foreach ($events as $event) {
            $day = $event->date->format("j");
            if (!isset($group_day_events[$day])) {
                $group_day_events[$day] = [];
            }
            array_push($group_day_events[$day], $event);
        }

        //holds calendar blocks
        $days_blocks = array();
        $index_key = 0;

        //prepend
        $day_of_week = $current_date->copy()->startOfMonth()->format("w");
        for ($i = 0; $i < $day_of_week; $i++) {
            $days_blocks[$index_key] = [
                "key"   => $index_key,
                "label" => "",
                "events"=> []
            ];
            $index_key++;
        }

        //days
        $days_in_month = $current_date->copy()->endOfMonth()->format("j");
        for ($i = 1; $i <= $days_in_month; $i++) {
            $days_blocks[$index_key] = [
                "key"   => $index_key,
                "label" => $i,
                "events"=> isset($group_day_events[$i])? $group_day_events[$i] : []
            ];
            $index_key++;
        }

        //append
        $append_size = 35 - count($days_blocks);

        //dont append anything if february fits in 4 rows
        if ($days_in_month == 28 && $day_of_week == 0) {
            $append_size = 0;
        }

        for ($i = 0; $i < $append_size; $i++) {
            $days_blocks[$index_key] = [
                "key"   =>  $index_key,
                "label" => "",
                "events"=> []
            ];
            $index_key++;
        }

        $params = [
            "events"        => $events,
            "current_date"  => $current_date,
            "previous_date" => $previous_date,
            "next_date"     => $next_date,
            "month_name"    => $current_date->format("M"),
            "year"          => $current_date->format("Y"),
            "days_blocks"   => $days_blocks,
            "month"         => $current_date->format("n"),
        ];

        return view("events.calendar", $params);
    }
}
