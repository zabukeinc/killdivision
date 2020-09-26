<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapter;
use Illuminate\Support\Str;
use File;
class ChapterController extends Controller
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
        $chapter = Chapter::orderBy("name", "DESC")->get();

        if(request()->q != ""){
            $chapter = $chapter->where("name", "LIKE", "%" . request()->q . "%");
        }

        return view("chapters.index", compact("chapter"));
    }

    public function create(){
        $chapter = Chapter::orderBy("name", "DESC")->get();

        return view("chapters.create", compact("chapter"));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            "image" => "nullable|image|mimes:png,jpeg,jpg"
        ]);


        if($request->hasFile("image")){
            $file = $request->file("image");
            $filename = time() . Str::slug($request->name) . "." . $file->getClientOriginalExtension();

            $file->storeAs('public/chapters', $filename);

            $chapter = Chapter::create([
                "name" => $request->name,
                "description" => $request->description,
                "slug" => Str::slug($request->name),
                "image" => $filename
            ]);
        }

        return redirect(route("chapter.index"))->with(["success" => "Data chapter berhasil ditambah"]);
    }

    public function edit($id){
        $chapters = Chapter::find($id);
        return view('chapters.edit', compact('chapters'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            "image" => "nullable|image|mimes:png,jpeg,jpg"
        ]);

        $chapter = Chapter::find($id);

        $filename = $chapter->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/chapters', $filename);
            File::delete(storage_path('app/public/chapters/' . $chapter->image));
        }

        $chapter->update([
            "name" => $request->name,
            "description" => $request->description,
            "slug" => Str::slug($request->name),
            "image" => $filename
        ]);

        return redirect(route("chapter.index"))->with(["success" => "Data chapter berhasil diupdate"]);
    }

    public function destroy($id){
        $chapter = Chapter::find($id);

        $chapter->delete();

        return redirect(route("chapter.index"))->with(["success" => "Data chapter berhasil dihapus"]);
    }
}
