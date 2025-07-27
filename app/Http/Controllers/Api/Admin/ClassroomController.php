<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Requests\ClassroomRequestStore;

class ClassroomController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::with('Grades')->paginate(10);
        return $this->returnData('Classrooms', ClassroomResource::collection($classrooms), 'Classrooms Returned');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequestStore $request)
    {
        try {
            $classroom = Classroom::create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'grade_id' => $request->grade_id
            ]);

            return $this->returnSuccessMessage('Classroom Created', new ClassroomResource($classroom));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        try {

            return $this->returnData('Classroom', new ClassroomResource($classroom), 'Classroom Returned');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        try {

            $validated_data = $request->validated();
            $classroom->update($validated_data);


            return $this->returnSuccessMessage('Classroom Updated', new ClassroomResource($classroom));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        try {

            $classroom->delete();
            return $this->returnSuccessMessage('Classroom deleted');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
