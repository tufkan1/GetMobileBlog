<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AppController extends Controller
{

    public function getUserData(){
        $this->middleware('web');
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://127.0.0.1:8000/api/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get("token")["access_token"],
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode((string) $response->getBody(), true)["user"];
    }

    public function getDepartments(){
        $this->middleware('web');
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://127.0.0.1:8000/api/departments', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get("token")["access_token"],
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode((string) $response->getBody(), true)["departments"];
    }

    public function index(){
        // get user department blogs accepted
        $blogs = Blog::where("department_ids", "LIKE", "%\"". $this->getUserData()["department"]["id"] ."\"%")->where("accept", 1)->get();

        return view('app', ["user" => $this->getUserData(), "blogs" => $blogs]);
    }

    public function create(){
        $data["user"] = $this->getUserData();

        if (in_array('add_blogs', Arr::pluck($data['user']['role']['permissions'], 'name'))){
            $data["departments"] = $this->getDepartments();

            return view("create", $data);
        }else{
            return redirect()->route("app.index");
        }
    }

    public function createForm(Request $request){
        $blog = new Blog();

        $blog->name = $request->name;
        $blog->content = $request->content;
        $blog->department_ids = json_encode($request->departments);
        $blog->save();

        return redirect()->route("app.index");
    }


    public function edit($id){
        $data["blog"] = Blog::find($id)->firstOrFail();

        $data["user"] = $this->getUserData();

        if (in_array('edit_blogs', Arr::pluck($data['user']['role']['permissions'], 'name'))){
            $data["departments"] = $this->getDepartments();

            return view("edit", $data);
        }else{
            return redirect()->route("app.index");
        }
    }

    public function editForm(Request $request, $id){
        $blog = Blog::find($id)->firstOrFail();

        $blog->name = $request->name;
        $blog->content = $request->content;
        $blog->department_ids = json_encode($request->departments);
        $blog->save();

        return redirect()->route("app.index");
    }

    public function delete($id){
        $blog = Blog::find($id)->firstOrFail();

        if (in_array('delete_blogs', Arr::pluck($this->getUserData()['role']['permissions'], 'name'))){
            $blog->delete();
        }

        return redirect()->route("app.index");
    }

    public function accept(){
        $data["user"] = $this->getUserData();

        if (in_array('accept_blogs', Arr::pluck($data['user']['role']['permissions'], 'name'))){
            $data["blogs"] = Blog::where("accept", 0)->get();

            return view("accept", $data);
        }else{
            return redirect()->route("app.index");
        }
    }

    public function acceptForm($id){
        $blog = Blog::where("id", $id)->firstOrFail();

        if (in_array('accept_blogs', Arr::pluck($this->getUserData()['role']['permissions'], 'name'))){
            $blog->accept = 1;
            $blog->save();
        }

        return redirect()->route("app.index");
    }
}
