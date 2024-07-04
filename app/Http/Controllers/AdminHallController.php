<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seance;
use App\Models\Seat;

//use Illuminate\Http\Request;
use App\Http\Requests\HallRequest;
use Illuminate\Http\Response;

class AdminHallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Hall::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HallRequest $request
     * //     * @return Response
     */
    public function store(HallRequest $request)
    {
        return Hall::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $hall = Hall::findOrFail($id);
        return $hall->seats;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HallRequest $request
     * @param Hall $hall
     * @return bool
     */
    public function update(HallRequest $request, Hall $hall): bool
    {
        $hall->fill($request->validated());
        return $hall->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hall $hall
     * @return ?Response
     */
    public function destroy(Hall $hall): ?Response
    {
        // удалить сеансы и сидения для этого зала
        Seat::where('hall_id', $hall['id'])->delete();
        Seance::where('hall_id', $hall['id'])->delete();
        if ($hall->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
