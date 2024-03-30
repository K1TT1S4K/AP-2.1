<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $name, $gender, $height, $weight, $photo;

    public function UpdateProfile(){

        try{



            if($this->photo){
                $fullpath = $this->photo->store('photos','public');
                $model = User::find(auth()->user()->id);
                $model->profile_photo_path = $fullpath;
                $model->save();
            }


            //dd($model);
            //dd(auth()->user());
            User::where('id',auth()->user()->id)
            ->update([
                'name' => $this->name,
                //'email' => $this->email,
                //'phone_number' => $this->phone_number,
                //'department' => $this->department
            ]);
            session()->flash('message', 'successfully updated.');
        } catch(\Exception $e) {
            session()->flash('error',$e->getMessage());
        }
    }

    public function mount(){
        $this->name = auth()->user()->name;
    }
    public function render()
    {

        return view('livewire.profile');
    }
}
