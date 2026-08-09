<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Vacancy;
use Carbon\Carbon;
use http\Env\Request;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithFileUploads;


class Applicants extends Component
{
    use WithFileUploads;

    public  $applicants, $first_name, $last_name, $middle_name,

        $street_address,  $city,  $state,  $zipcode,

        $sex, $civil_status, $birth_date, $birth_place, $age,
//        $job_id,
//        $user_name, $password,
        $email_address, $contact_no, $degree, $file_attachment, $applicant_id;

    public $updateMode = false;
//    public function mount($id){
//        $this->vacancy = Vacancy::find($id);
//    }
    public function render()
    {
//        $this->vacancy = Vacancy::all();
        $this->applicants = Applicant::all();
        return view('livewire.applicants');

    }

    private function resetInputFields(){
        $this->first_name = '';
        $this->last_name = '';
        $this->middle_name = '';

        $this->street_address = '';
        $this->city = '';
        $this->state = '';
        $this->zipcode = '';

        $this->sex = '';
        $this->civil_status  = '';
        $this->birth_date = '';
        $this->birth_place  = '';
        $this->age  = '';
//        $this->user_name = '';
//        $this->password = '';
        $this->email_address = '';
        $this->contact_no = '';
        $this->degree = '';
        $this->file_attachment = '';
     }


    public function store()
    {
//        return dd(time().'_'.$this->file_attachment);
//        if($request->myfile()) {
//            $fileName = time().'_'.$req->file->getClientOriginalName();
//            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
//            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
//            $fileModel->file_path = '/storage/' . $filePath;
//            $fileModel->save();
//            return back()
//                ->with('success','File has been uploaded.')
//                ->with('file', $fileName);
//        }

        try {
            $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // 'middle_name' => 'required',
    //            'address' => 'required',

                'street_address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zipcode' => 'required',

                'sex' => 'required',
                'civil_status' => 'required',
                'birth_date' => 'required|date',
                'birth_place' => 'required',
    //            'age' => 'required',
    //            'user_name' => 'required',
    //            'password' => 'required',
    //            'email_address' => 'required',
                'contact_no' => 'required',
                'degree' => 'required',
                // 'file_attachment' => 'required',
            ]);

    //        $this->file_attachment->store('pdf');

    //        $vacancies = DB::table('tbl_job_list');



            if (!empty(auth()->user()->id)) {

                $years = Carbon::parse($this->birth_date);

                $idad = $years->age;

                Applicant::create([
        //            $data,$data2,

                    'applicant_id' => auth()->user()->id,
    //                'job_id' => $this->job_id,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'middle_name' => $this->middle_name,

                    'street_address' => $this->street_address ,
                    'city' => $this->city,
                    'state' => $this->state,
                    'zipcode' => $this->zipcode,

                    'sex' => $this->sex,
                    'civil_status' => $this->civil_status,
                    'birth_date' => $this->birth_date,
                    'birth_place' => $this->birth_place,
                    'age' => $idad,
        //            'user_name' => $this->user_name,
        //            'password' => $this->password,
                    'email_address' => auth()->user()->email,
                    'contact_no' => $this->contact_no,
                    'degree' => $this->degree,
                    'file_attachment' => $this->file_attachment->store(''),
                    'remarks' => 'Pending',

                ]);
            }
    //        if($req->file()) {
    //            $fileName = time().'_'.$req->file->getClientOriginalName();
    //            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
    //            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
    //            $fileModel->file_path = '/storage/' . $filePath;
    //            $fileModel->save();
    //            return back()
    //                ->with('success','File has been uploaded.')
    //                ->with('file', $fileName);
    //        }




    //        Applicant::create($validatedDate);

            session()->flash('message', 'Applicant Created Successfully.');

            $this->resetInputFields();
            
        } catch (Exception $e) {
            return response()->json(['e' =>  $e]);
        }
        

    }


    public function edit($id)
    {

        $applicant = Applicant::findOrFail($id);

        $this->applicant_id = $id;

        $this->first_name = $applicant->first_name;
        $this->last_name = $applicant->last_name;
        $this->middle_name = $applicant->middle_name;

//        $this->address = $applicant->address;
        $this->street_address = $applicant->street_address;
        $this->city = $applicant->city;
        $this->state = $applicant->state;
        $this->zipcode = $applicant->zipcode;

        $this->sex = $applicant->sex;
        $this->civil_status = $applicant->civil_status;
        $this->birth_date = $applicant->birth_date;
        $this->birth_place = $applicant->birth_place;
        $this->age = $applicant->age;

//        $this->user_name = $applicant->user_name;
//        $this->password = $applicant->password;
        $this->email_address = $applicant->email_address;
        $this->contact_no = $applicant->contact_no;
        $this->degree = $applicant->degree;
//        $filepath = Storage::get('' . $applicant->file_attachment);
        $this->file_attachment = $applicant->file_attachment;

        $this->updateMode = true;
    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        $validatedDate = $this->validate([
            'first_name' => 'required', 'last_name' => 'required',
            // 'middle_name' => 'required',

            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',

            'sex' => 'required',
            'civil_status' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'age' => 'required|numeric|min:18',
//            'user_name' => 'required', 'password' => 'required',
            'email_address' => 'required', 'contact_no' => 'required', 'degree' => 'required',
            // 'file_attachment' => 'required'
        ]);

        $applicant = Applicant::find($this->applicant_id);


        $applicant->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,

//            'address' => $this->address,

            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,

            'sex' => $this->sex,
            'civil_status' => $this->civil_status,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'age' => $this->age,
//            'user_name' => $this->user_name,
//            'password' => $this->password,
//            'file_attachment' => $this->file_attachment->store(''),
            'file_attachment' => $this->file_attachment,
            'email_address' => $this->email_address,
            'contact_no' => $this->contact_no,
            'degree' => $this->degree,
        ]);


        $this->updateMode = false;

        session()->flash('message', 'Applicant Updated Successfully.');
        $this->resetInputFields();
    }


    public function delete($id)
    {
        Applicant::find($id)->delete();
        session()->flash('message', 'applicant Deleted Successfully.');
    }
    public function download($id)
    {
        $applicants = \DB::table('applicants')->where('applicants.file_attachment', $id)->first();
        $filepath = \Storage::disk('')->path(''.$applicants->file_attachment);
        return \Response::file($filepath);
    }

}
