<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    // all urls
    public function index()
    {
        $shortUrls = ShortUrl::all()->toArray();
        return array_reverse($shortUrls);
    }
    // add add
    public function add(Request $request)
    {
        $checkUrlExist = ShortUrl::where('orginal_url',$request->input('long_url'))->first();

        if($checkUrlExist){
            return response()->json([
                'status' => 'failed',
                'code' => '304',
                'message' => 'Previously created' 
            ]);    
        }
        try{
       
            $appUrl = config('app.url');

            // Str::random() returns unique string and it takes string langth as parameter
            // new shor url is constructing here
            $generatedURL = $appUrl.'/'.Str::random(6);

            $shortUrl = new ShortUrl([
                'generated_url' => $generatedURL,
                'orginal_url' => $request->input('long_url')
            ]);
            $shortUrl->save();
            return response()->json([
                'status' => 'success',
                'code' => '200',
                'message' => 'The url successfully added' 
            ]);  
        }catch(\Exception $ex){
            return response()->json([
                'status' => 'failed',
                'code' => '400',
                'message' => 'Url not being created, Please Try again' 
            ]);    
        }
    }
   
    // delete url
    public function delete($id)
    {
        $shortUrl = ShortUrl::find($id);
        $shortUrl->delete();
        return response()->json('The url successfully deleted');
    }

    public function rdireturl($code)
    {
        $appUrl = config('app.url');

        // Str::random() returns unique string and it takes string langth as parameter
        // new shor url is constructing here
        $generatedURL = $appUrl.'/'.$code;

        $checkUrlExist = ShortUrl::where('generated_url',$generatedURL)->first();
        if($checkUrlExist){
            return redirect($checkUrlExist->orginal_url);
        }else{
            echo "wrong url";
        }
    }
}
