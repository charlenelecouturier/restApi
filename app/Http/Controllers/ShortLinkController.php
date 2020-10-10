<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        ShortLink::create($input);

        return redirect('generate-shorten-link')
             ->with('success', 'Short link generated!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();

        return redirect($find->link);
    }

    /**
     * Delete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
  
        $id=$request->id;
        $link = ShortLink::where('id', $id)->delete();;
        return redirect('generate-shorten-link')
        ->with('success', 'Short link deleted!');

    }

    public function findAction(\Illuminate\Http\Request $request) {
        if ($request->has('add')) {
            return $this->store($request);
        } else if ($request->has('delete')) {
            return $this-> delete($request);
        }
        return redirect('generate-shorten-link')
        ->with('error', 'No action found!');
    }

    
}