<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Hall;
use App\Models\Movie;

//use Illuminate\Http\Request;
use App\Models\Seance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Movie::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MovieRequest $request
     * @return Response
     */
    public function store(MovieRequest $request): Response
    {
        $validatedMovie = $request->validated();
        $validatedMovie['picture'] = '';// файл сохраним отдельно ниже
        Movie::create($validatedMovie);
        $createdMovie = Movie::latest()->first();

        if ($request->hasFile('picture')) {
            $movieId = $createdMovie->id;
            // расширение файла
            $extention = $request->file('picture')->extension();
            // имя файла для сохранения
            $fileNameToStore = 'poster' . $movieId . '.' . $extention;
            // Сохраняем файл
            $path = $request->file('picture')->storeAs('public/posters', $fileNameToStore);
            if ($path) {
                $createdMovie['picture'] = asset('storage/posters/' . $fileNameToStore);
            } else {
                //тогда создаем кино без картинки
                $createdMovie['picture'] = '';
            }
            $createdMovie->save();
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
        return Movie::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovieRequest $request
     * @param Movie $movie
     * @return bool
     */
    public function update(MovieRequest $request, Movie $movie): bool
    {
        $validatedMovie = $request->validated();
        if ($validatedMovie['picture'] === null) {
            //найти сущ. файл постера для фильма и удалить, если есть
            $existFilePath = 'public/posters/' . pathinfo($movie['picture'], PATHINFO_BASENAME);
            Storage::delete($existFilePath);
            $validatedMovie['picture'] = '';
            $movie->fill($validatedMovie);
        }
        if ($request->hasFile('picture')) {
            $movieId = $movie['id'];
            // расширение файла
            $extention = $request->file('picture')->extension();
            // имя файла для сохранения
            $fileNameToStore = 'poster' . $movieId . '.' . $extention;
            // Сохраняем файл
            $path = $request->file('picture')->storeAs('public/posters', $fileNameToStore);

            if ($path) {
                $validatedMovie['picture'] = asset('storage/posters/' . $fileNameToStore);
            } else {
                //тогда создаем кино без картинки
                unset ($validatedMovie['picture']);
            }
            $movie->fill($validatedMovie);
        }

        if ($validatedMovie['picture'] !== null) {
            unset ($validatedMovie['picture']);
            $movie->fill($validatedMovie);
        }
        return $movie->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return ?Response
     */
    public function destroy(Movie $movie): ?Response
    {
        //удалить связанные сеансы
        Seance::where('movie_id', $movie['id'])->delete();
        if ($movie->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
