<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use Illuminate\Support\Str;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $home = Home::orderBy("title", "DESC")->get();

        if(request()->q != ""){
            $home = $home->where("title", "LIKE", "%" . request()->q . "%");
        }

        return view("home", compact("home"));
    }

    public function create(){
        $home = Home::orderBy("title", "DESC")->get();

        return view("create", compact("home"));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        if($request->hasFile("image")){
            $file = $request->file("image");
            $filename = time() . Str::slug($request->title) . "." . $file->getClientOriginalExtension();

            $file->storeAs('public/home', $filename);

            $home = Home::create([
                "title" => $request->title,
                "subtitle" => $request->subtitle,
                "image" => $filename
            ]);
        }

        return redirect(route("home.index"))->with(["success" => "Data home berhasil ditambah"]);
    }

    public function edit($id){
        $home = Home::find($id);
        return view('edit', compact('home'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $home = Home::find($id);
        $filename = $home->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/home', $filename);
            File::delete(storage_path('app/public/home/' . $home->image));
        }

        $home->update([
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "image" => $filename
        ]);

        return redirect(route("home.index"))->with(["success" => "Data home berhasil diupdate"]);
    }

    public function destroy($id){
        $home = Home::find($id);
        File::delete(storage_path('app/public/home/' . $home->image));

        $home->delete();

        return redirect(route("home.index"))->with(["success" => "Data home berhasil dihapus"]);
    }
}
