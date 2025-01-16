<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MyParent;
use App\Models\Religion;
use App\Models\TypeBlood;
use App\Models\Nationalitie;
use Livewire\WithFileUploads;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Hash;

class AddParent extends Component
{


    public $successMessage = '';

    public $catchError,$updateMode = false,$photos,$show_table = true,$Parent_id;

    public $currentStep = 1,

        // Father_INPUTS
        $Email, $Password,$id,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;




    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
            'my_parents' => MyParent::all(),
        ]);

    }
    public function routeRedirect(){
         $currentLocale = app()->getLocale();
         $route='add_parent_'.$currentLocale;
         return $route;
    }

    public function showformadd(){
        $this->show_table = false;
    }



    //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
            'Email' => 'required|unique:my_parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
           $parent= MyParent::create([

                // FatherInf
                'email'=>$this->Email,
                'password'=>Hash::make($this->Password),
                'name_Father'=>['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'national_ID_Father'=>$this->National_ID_Father,
                'passport_ID_Father'=>$this->Passport_ID_Father,
                'phone_Father'=>$this->Phone_Father,
                'job_Father'=>['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'passport_ID_Father'=>$this->Passport_ID_Father,
                'nationality_Father_id'=>$this->Nationality_Father_id,
                'blood_Type_Father_id'=>$this->Blood_Type_Father_id,
                'religion_Father_id'=>$this->Religion_Father_id,
                'address_Father'=>$this->Address_Father,

                // Mother_INPUTS
                'name_Mother'=>['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'national_ID_Mother'=>$this->National_ID_Mother,
                'passport_ID_Mother'=>$this->Passport_ID_Mother,
                'phone_Mother'=>$this->Phone_Mother,
                'job_Mother'=>['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'passport_ID_Mother'=>$this->Passport_ID_Mother,
                'nationality_Mother_id'=>$this->Nationality_Mother_id,
                'blood_Type_Mother_id'=>$this->Blood_Type_Mother_id,
                'religion_Mother_id'=>$this->Religion_Mother_id,
                'address_Mother'=>$this->Address_Mother,
            ]);

            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => $parent->id,
                    ]);
                }
            }
            $this->currentStep = 1;
            return redirect()->route($this->routeRedirect())->
            with('msg', trans('messages.success'))->with('type', 'success');

        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }


    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = MyParent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->email;
        $this->Password = $My_Parent->password;
        $this->Name_Father = $My_Parent->getTranslation('name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('job_Father', 'en');
        $this->National_ID_Father =$My_Parent->national_ID_Father;
        $this->Passport_ID_Father = $My_Parent->passport_ID_Father;
        $this->Phone_Father = $My_Parent->phone_Father;
        $this->Nationality_Father_id = $My_Parent->nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->blood_Type_Father_id;
        $this->Address_Father =$My_Parent->address_Father;
        $this->Religion_Father_id =$My_Parent->religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->national_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->blood_Type_Mother_id;
        $this->Address_Mother =$My_Parent->address_Mother;
        $this->Religion_Mother_id =$My_Parent->religion_Mother_id;
    }

    //firstStepSubmit_edit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }

    public function submitForm_edit(){

        if ($this->Parent_id){
            $parent = MyParent::find($this->Parent_id);
            $parent->update([
                // FatherInf
                'email'=>$this->Email,
                'password'=>Hash::make($this->Password),
                'name_Father'=>['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'national_ID_Father'=>$this->National_ID_Father,
                'passport_ID_Father'=>$this->Passport_ID_Father,
                'phone_Father'=>$this->Phone_Father,
                'job_Father'=>['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'passport_ID_Father'=>$this->Passport_ID_Father,
                'nationality_Father_id'=>$this->Nationality_Father_id,
                'blood_Type_Father_id'=>$this->Blood_Type_Father_id,
                'religion_Father_id'=>$this->Religion_Father_id,
                'address_Father'=>$this->Address_Father,

                // Mother_INPUTS
                'name_Mother'=>['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'national_ID_Mother'=>$this->National_ID_Mother,
                'passport_ID_Mother'=>$this->Passport_ID_Mother,
                'phone_Mother'=>$this->Phone_Mother,
                'job_Mother'=>['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'passport_ID_Mother'=>$this->Passport_ID_Mother,
                'nationality_Mother_id'=>$this->Nationality_Mother_id,
                'blood_Type_Mother_id'=>$this->Blood_Type_Mother_id,
                'religion_Mother_id'=>$this->Religion_Mother_id,
                'address_Mother'=>$this->Address_Mother,


            ]);

        }

        return redirect()->route($this->routeRedirect())->
        with('msg', trans('messages.Update'))->with('type', 'success');
    }

    public function delete($id){
        MyParent::findOrFail($id)->delete();
        return redirect()->route($this->routeRedirect())->
        with('msg', trans('messages.Delete'))->with('type', 'danger');;
    }


    public function back($step)
    {
        $this->currentStep = $step;
    }
}
