<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(Request $request){

        $slug =  str_replace(" " , "-" , $request->name);

        $request->merge(['slug' => $slug]);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'unique:categories,slug',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            return  response()->json([
                'message' => 'Invalid data send',
                'details' => $errors->messages(),
            ], 422);

        }

        Category::create([
            "name" => $request['name'],
            'slug' => $slug,
        ]);

        return response()->json("Category Created Successfully !");
    }
}
