<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Requests\GradeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\GradeResource;
use App\Http\Requests\GradeRequestStore;


class GradeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $grades = Grade::paginate(10);
        return $this->returnData('Grades', GradeResource::collection($grades), 'success message');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequestStore $request)
    {
        try{

        $grade=Grade::create([
            'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
            'notes'=>$request->notes
        ]);

        return $this->returnSuccessMessage('Grade Created',new GradeResource($grade));

        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        try{

        return $this->returnData('Grade',new GradeResource($grade),'Grade Returned');

        }catch(\Exception $ex){
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade)
    {
        try{

        $validated_data = $request->validated();
        $grade->update($validated_data);

        return $this->returnSuccessMessage('Grade Updated',new GradeResource($grade));

        }catch(\Exception $ex){
            return $this->returnError($ex->getCode(),$ex->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
         try{
        $grade->delete();
        return $this->returnSuccessMessage('Grade deleted');

        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
