<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TeacherRequest;
use App\Http\Resources\GenderResource;
use App\Http\Resources\TeacherResource;
use App\Http\Requests\TeacherRequestStore;
use App\Http\Resources\SpecializationResource;

class TeacherController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);
        return $this->returnData('Teachers', TeacherResource::collection($teachers), 'success message');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequestStore $request)
    {
        try {


            $teacher = Teacher::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'specialization_id' => $request->specialization_id,
                'gender_id' => $request->gender_id,
                'joining_Date' => $request->joining_Date,
                'address' => $request->address,
            ]);

            return $this->returnSuccessMessage('Teacher Created', new TeacherResource($teacher));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        try {

            return $this->returnData('Teacher', new TeacherResource($teacher), 'Teacher Returned');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        try {

            $validated_data = $request->validated();
            $teacher->update($validated_data);

            return $this->returnSuccessMessage('Teacher Updated', new TeacherResource($teacher));
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $teacher->delete();
            return $this->returnSuccessMessage('Teacher deleted');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function getSpecialization()
    {
        try {
            $specializations = Specialization::paginate(10);
            return $this->returnData('Specializations', SpecializationResource::collection($specializations), 'success message');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function getGender()
    {
        try {
            $genders = Gender::paginate(10);
            return $this->returnData('Genders', GenderResource::collection($genders), 'success message');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
