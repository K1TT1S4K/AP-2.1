<?php

namespace App\Livewire\Article;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;
    public $title, $detail, $file, $photo;
    public function add(){
        $this->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'กรุณากรอกชื่อ',
            'title.min' => 'กรุณากรอกข้อมูลมากกว่า 2 ตัวอักษร',
        ]);
        //dd($this->weight);
        try{
            $model = User::create([
                'title' => $this->title,
                'detail' => $this->detail,
                // 'password' => Hash::make($this->password),
                'create_by' => auth()->user()->id,
                // 'is_admin' => $this->is_admin,

            ]);
            if($this->article_image){
                $fullpath = $this->image->store('images','public');
                $model->article_image_path = $fullpath;
                $model->save();
            }
            return redirect()->to(route('article'));
        }
        catch(\Exception $e){
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.article.add');
    }
}
