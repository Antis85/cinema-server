<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seance;
use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use App\Models\TicketSeat;
use Illuminate\Http\Response;

const SLASH = DIRECTORY_SEPARATOR;
require_once app_path() . SLASH . 'Phpqrcode' . SLASH . 'phpqrcode.php';

use Illuminate\Support\Str;
use QRcode;

class ClientTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Ticket::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return Response
     */
    public function store(TicketRequest $request): Response
    {
        $validated = $request->validated();
        $validatedTicket = $request->safe()->except('seats');
        $ticketSeats = TicketSeat::get();
        $halls = Hall::get();
        $seances = Seance::get();
        foreach ($ticketSeats as $seat) {
            $seat->ticket;
        }
        //проверяем доступность выбранных мест в зале для бронирования
        $requestSeatsIds = $validated['seats']['seatsIds'];
        $existSeats = $ticketSeats->where('ticket.date', $validated['date'])->whereIn('seat_id', $requestSeatsIds);
        $hasExistSeats = count($existSeats);
        if ($hasExistSeats !== 0) {
            $existSeatsHallId = Seance::findOrFail($existSeats->first()->ticket->seance_id)->hall->id;
            $existHallSeats = $halls->find($existSeatsHallId)->seats->whereIn('id', $requestSeatsIds)->values()->map(function ($item, $key) {
                return 'ID:' . $item['id'] . ',row:' . $item['index_row'] . ',seat:' . $item['index_col'] . ';';
            });
            $existHallSeatsStr = $existHallSeats->implode(' ');
            return response('Seats has been already ordered: ' . $existHallSeatsStr, Response::HTTP_BAD_REQUEST);
        }
        //создаем билет
        $validatedTicket['uuid'] = Str::uuid()->toString();
        $qrInfo = $validatedTicket;
        unset ($qrInfo['seance_id']);
        $qrInfo['seance_time'] = $seances->find($validated['seance_id'])->start_time;
        $qrInfo['seats_info'] = $validated['seats']['seatsInfo'];
        $qrInfoStr = "TICKET UUID: " . $qrInfo['uuid'] . "\n";
        $qrInfoStr .= "DATE: " . $qrInfo['date'] . "\n";
        $qrInfoStr .= "SEANCE TIME: " . $qrInfo['seance_time'] . "\n";
        $qrInfoStr .= "SEATS: \n" . implode("\n", $qrInfo['seats_info']);
        $qrFileStr = 'storage/qrcodes/' . $validatedTicket['uuid'] . '.png';
        QRcode::png($qrInfoStr, public_path($qrFileStr), 'H');
        $isQrReadyOrFail = is_file(public_path($qrFileStr)) ? asset($qrFileStr) : 'error';
        $validatedTicket['qr_code'] = $isQrReadyOrFail;
        Ticket::create($validatedTicket);
        $createdTicket = Ticket::latest()->first();
        foreach ($requestSeatsIds as $seatId) {
            $ticketSeat = array('ticket_id' => $createdTicket->id, 'seat_id' => $seatId);
            TicketSeat::create($ticketSeat);
        }
        return response(array('qr' => $createdTicket->qr_code, 'uuid' => $createdTicket->uuid), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        return Ticket::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketRequest $request
     * @param Ticket $ticket
     * @return bool
     */
    public function update(TicketRequest $request, Ticket $ticket): bool
    {
        $ticket->fill($request->validated());
        return $ticket->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return ?Response
     */
    public function destroy(Ticket $ticket): ?Response
    {
        if ($ticket->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
