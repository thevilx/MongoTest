<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function create(Request $request){

        $slug =  str_replace(" " , "-" , $request->name);

        $request->merge(['slug' => $slug]);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'unique:tags,slug',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            return  response()->json([
                'message' => 'Invalid data send',
                'details' => $errors->messages(),
            ], 422);

        }

        Tag::create([
            "name" => $request['name'],
            'slug' => $slug,
        ]);

        return response()->json("Article Created Successfully !");
    }


}
