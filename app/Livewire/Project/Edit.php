<?php

namespace App\Livewire\Project;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public $idd,$name,$email,$photo;
    public function edit(){
        User::where('id', $this->idd)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        return redirect()->to(route('project'));

    }
    public function mount($id){
        $data = User::find($id);
        $this->idd = $id;
        $this->name = $data->name;
        $this->email = $data->email;
        //dd($data);
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
