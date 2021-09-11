<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Product;

class XmlController extends Controller
{
   

    public function fileUpload()
    {
        return view('fileUpload');
    }
  
    


    public function fileUploadPost(Request $request)
    {
    // upload file

        $request->validate([
            'file' => 'required|mimes:xml',
        ]);
  
        $fileName = hexdec(uniqid()).'.'.$request->file->getClientOriginalExtension();  
        $request->file->move(public_path('upload'), $fileName);

    // file to array

        $xmlString = file_get_contents(public_path('upload/'.$fileName));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true); 
   
      
        for ($i=0; $i<=count($phpArray["food"])-1; $i++){
        Product::insert([            
            'name' =>  $phpArray["food"][$i]['name'],  
            'price' =>  $phpArray["food"][$i]['price'], 
            'description' => json_encode($phpArray["food"][$i]['description']),
            'calories' =>  $phpArray["food"][$i]['calories'], 
            
        ]);
    }
   
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
   
    }



   
}
