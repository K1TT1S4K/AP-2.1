<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        //$data = User::all();
        $data = User::Paginate(2);
        return view('livewire.project')->with(compact('data'));
    }
    public function delete($idd){

        //dd($idd);
        $model = User::find($idd);
        $model->delete_by = auth()->user()->id;
        $model->save();
        $model->delete();
    }
}
