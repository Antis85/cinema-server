<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatRequest;
use App\Models\Hall;
use App\Models\Seat;

//use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;

class AdminSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Seat::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SeatRequest $request
     * @return Response
     */
    public function store(SeatRequest $request): Response
    {
        $validated = $request->validated();
        $seats = $validated['seats'];
        $hallId = $validated['hallId'];

        if ($hallId) {
            Seat::where('hall_id', $hallId)->delete();
        }
        foreach ($seats as $seat) {
            Seat::create($seat);
        }
        return response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        return Seat::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SeatRequest $request
     * @param Seat $seat
     * @return bool
     */
    public function update(SeatRequest $request, Seat $seat): bool
    {
        $seat->fill($request->validated());
        return $seat->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Seat $seat
     * @return ?Response
     */
    public function destroy(Seat $seat): ?Response
    {
        if ($seat->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
