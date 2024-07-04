<?php

namespace App\Http\Controllers;

//use App\Http\Requests\MovieRequest;
//use App\Models\Hall;
use App\Models\Movie;

//use Illuminate\Http\Request;
//use App\Models\Seance;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ClientMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //получаем спиок фильмов с сеансами сгруппированными по залам
        $movies = Movie::get();
        foreach ($movies as $movie) {
            $halls = $movie->halls;
            $mod_halls = $halls->map(function ($item) {
                return array(
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'seance' => array(
                        'id' => $item['pivot']['id'],
                        'start_time' => $item['pivot']['start_time'],
                    ),
                );
            });
            $groupedSeances = $mod_halls->mapToGroups(function ($hall) {
                return array($hall['id'] => $hall['seance']);
            });
            $mod_halls = $halls->unique('id')->values()->map(function ($hall) use ($groupedSeances) {
                return array(
                    'id' => $hall['id'],
                    'name' => $hall['name'],
                    'seances' => $groupedSeances["{$hall['id']}"],
                );
            });
            $halls->transform(function ($item, $key) use ($mod_halls) {
                if ($mod_halls->has($key)) return $mod_halls["$key"];
            });
        }
        return $movies;
    }
}
