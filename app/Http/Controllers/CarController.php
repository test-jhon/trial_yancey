<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarColor;
use App\Http\Resources\CarResource;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarResource::collection(Car::with('manufacturer', 'type', 'colors')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $remove_dupe_color_id = array_values(array_unique($request->color_id));

        $q = Car::create($request->except('color_id'));
        
        for ($i = 0; $i < count($remove_dupe_color_id); $i++) {
            CarColor::create([
                'car_id' => $q->id,
                'color_id' => $remove_dupe_color_id[$i],
            ]);
        }

        return response('', 201)->header('Location', url("/api/cars/{$q->id}"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return Car::with('colors')->find($car->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        // just in case, remove duplicate input of color_id
        $remove_dupe_color_id = array_values(array_unique($request->color_id));

        $car->update($request->except('color_id'));

        // reset all colors associated to the car before filling it with new set of values
        CarColor::where('car_id', $car->id)->delete();

        for ($i = 0; $i < count($remove_dupe_color_id); $i++) {
            CarColor::create([
                'car_id' => $car->id,
                'color_id' => $remove_dupe_color_id[$i],
            ]);
        }

        return response()->json(Car::with('colors')->find($car->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        CarColor::where('car_id', $car->id)->delete();

        return response('', 204);
    }
}
