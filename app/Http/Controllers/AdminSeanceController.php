<?php

namespace App\Http\Controllers;

use App\Models\Seance;
//use Illuminate\Http\Request;
use App\Http\Requests\SeanceRequest;
use App\Models\Seat;
use Illuminate\Http\Response;

class AdminSeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Seance::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SeanceRequest  $request
     * @return ?Response
     */
    public function store(SeanceRequest $request): ?Response
    {
        $validatedRemoveSeances=$request->safe()->only('remove_seances');
        $validatedCreateSeances=$request->safe()->only('create_seances');
        $response=null;

        if($validatedRemoveSeances) {
            foreach($validatedRemoveSeances['remove_seances'] as $seance){
                $id=$seance['id'];
                Seance::findOrFail($id)->delete();
            }
            $response=response(null, Response::HTTP_NO_CONTENT);
        }

        if($validatedCreateSeances) {
            foreach($validatedCreateSeances['create_seances'] as $seance){
                Seance::create($seance);
            }
            $response=response(null, Response::HTTP_CREATED);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
          return Seance::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SeanceRequest  $request
     * @param  Seance  $seance
     * @return bool
     */
    public function update(SeanceRequest $request, Seance $seance): bool
    {
        $seance->fill($request->validated());
        return $seance->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Seance  $seance
     * @return ?Response
     */
    public function destroy(Seance $seance): ?Response
    {
        if ($seance->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
