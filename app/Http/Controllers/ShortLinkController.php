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
     * Store a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'link' => 'required|url'
        ];
    
        $customMessages = [
            'required' => 'The field is required.',
            'url' => 'The url is not in the right format.'

        ];
    
        $this->validate($request, $rules, $customMessages);
        
        $input['link'] = $request->link;
        $input['code'] = Str::random(6);


        ShortLink::create($input);

        return redirect('/')
             ->with('success', 'Short link generated!');
    }

    /**
     * Creates and return a shortened url from an url given in the request
     *
     * @return \Illuminate\Http\Response
     */

    public function createAndSend(Request $request)
    { 
        $this->store($request);
        $find = ShortLink::where('link',$request->link)->first();
        return response()->json(array('short url'=> $find->code));
    }


    /**
     * Display the original url from a shortened url
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
  
        $rules = [
            'id' => 'required|numeric'
        ];
    
        $customMessages = [
            'required' => 'The field is required.',
            'numeric' => 'Something went wrong.'

        ];
    
        $this->validate($request, $rules, $customMessages);
        $id=$request->id;
        ShortLink::where('id', $id)->delete();;
        return redirect('/')
        ->with('success', 'Short link deleted!');

    }

    
}