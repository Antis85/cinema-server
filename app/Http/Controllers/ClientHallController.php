<?php

namespace App\Http\Controllers;

//use App\Http\Requests\MovieRequest;
//use App\Models\Hall;
use App\Models\Hall;
use App\Models\Movie;

//use Illuminate\Http\Request;
//use App\Models\Seance;
//use Illuminate\Database\Eloquent\Builder;
use App\Models\Seance;
use App\Models\Ticket;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ClientHallController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $date
     * @param $seanceId
     * @return Response
     */
    public function show($date, $seanceId)
    {
        //получаем информацию о зале для выбранного сеанса фильма
        $seance = Seance::findOrFail($seanceId);
        $seanceTickets = Ticket::get()->where('date', $date)->where('seance_id', $seanceId);
        foreach ($seanceTickets as $ticket) {
            $ticket->seats;
        }
        $seanceTicketsSeatsIds = $seanceTickets->map(function ($item, $key) {
            return $item['seats'];
        })->flatten()->map(function ($item) {
            return $item['seat_id'];
        });
        $seanceHall = $seance->hall;
        $hallSeats = $seanceHall->seats;
        $orderedSeats = $hallSeats->whereIn('id', $seanceTicketsSeatsIds)->values();
        foreach ($orderedSeats as $seat) {
            $seat['is_ordered'] = true;
        }
        $movieTitle = Movie::findOrFail($seance->movie->id)->title;
        $seanceHall['movie_title'] = $movieTitle;
        $seanceHall['start_time'] = $seance->start_time;
        return $seanceHall;
    }
}
