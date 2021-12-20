<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Post extends Component
{
    use WithPagination;
     protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'addPost' => 'addPost',
        'resetMessage' => 'resetMessage',
        'deletePost' => 'deletePost',
        'editPost' => 'editPost',
        'publishPost' => 'publishPost'
    ];
    public function render()
    {
        return view('livewire.post', [
            'listPost' => $this->listPost()
        ]);
    }

    public $title;
    public $content;
    public $message;


    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];


    public function listPost(){

        if(Auth::user()->roles == 1){
            return PostModel::orderBy('id', 'DESC')->paginate(5);
        }else{
            return PostModel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(3);
        }

    }

    public function resetMessage(){
        unset($this->message);
    }

    public function addPost($title, $content){

        $this->title = $title;
        $this->content = $content;

        $this->validate();

        $result = PostModel::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => Auth::user()->id,
        ]);

        if($result){
            $this->message = "You added post successfully!";
            $this->emit('resetPostScript');
        }

    }

    public function deletePost($id){
        $result = PostModel::find($id)->delete();
    }

    public function editPost($id, $title, $content){

        $this->title = $title;
        $this->content = $content;
        $this->validate();

        if(isset($id) and !empty($id)){
            $result = PostModel::where('id', $id)->update([
                'title' => $this->title,
                'content' => $this->content,
                'user_id' => Auth::user()->id,
            ]);
        }

        if($result){
            $this->message = "You edited post successfully!";
            $this->emit('resetPostScript');
        }

    }

    public function publishPost($id){

        if(Auth::user()->roles == 1){
            $result = PostModel::where('id', $id)->update([
                'publish' => 'published'
            ]);
        }

    }




}
