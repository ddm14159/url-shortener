<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Url;

class UrlController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        $url = $request->input('url');
        $oldUrl = Url::where('full', $url)->first();
        if ($oldUrl !== null) {
            return view('index', ['shortened' => $oldUrl->shortened]);
        }
        do {
            $shortened = Helper::getShortUrl();
            $oldShortened =  Url::where('shortened', $shortened)->first();
        } while ($oldShortened !== null);
        Url::create(['full' => $url, 'shortened' => $shortened]);
        return view('index', ['shortened' => $shortened]);
    }

    public function redirect(string $uri)
    {
        if (strlen($uri) <> 6) {
            abort(404);
        }
        $url = url()->current();
        $oldUrl = Url::where('shortened', $url)->first();
        if ($oldUrl === null) {
            abort(404);
        }
        return redirect()->away($oldUrl->full);
    }
}
