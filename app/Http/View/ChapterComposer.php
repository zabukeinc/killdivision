<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Chapter;

class ChapterComposer
{
    public function compose(View $view)
    {
        $chapter = Chapter::orderBy("created_at", "desc")->get();

        $view->with('chapter',$chapter);
    }
}