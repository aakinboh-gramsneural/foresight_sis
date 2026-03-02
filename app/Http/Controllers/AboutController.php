<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('slug', 'about')->firstOrFail();

        return view('pages.about', [
            'page' => $page,
            'content' => $page->content ?? [],
        ]);
    }
}
