<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    public function showAll(){
        return Article::all();
    }

    public function show(Article $article){

        return $article;
    }

    public function addToGroup(Request $request){

        $validator = Validator::make($request->all(),[
            'article_id' => 'required|exists:articles,_id',
            'category_id' => 'exists:categories,_id',
            'tag_id' => 'exists:tags,_id',
            // 'group_type' => 'in:category,tag',
        ]);



        if ($validator->fails()) {

            $errors = $validator->errors();

            return  response()->json([
                'message' => 'Invalid data send',
                'details' => $errors->messages(),
            ], 422);

        }


        $article = Article::find($request->article_id);

        if(isset($request->category_id)){
            // $article->category()->save(Category::find($request->category_id));
            (Category::find($request->category_id))->articles()->save($article);
            return "attached to category successfully !";
        }


        if(isset($request->tag_id)){
            $article->tags()->attach($request->tag_id);
            return "attached to tag successfully !";
        }


    }

    public function create(Request $request){

        $slug =  str_replace(" " , "-" , $request->title);

        $request->merge(['slug' => $slug]);

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'slug' => 'unique:articles,slug',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            return  response()->json([
                'message' => 'Invalid data send',
                'details' => $errors->messages(),
            ], 422);

        }

        Article::create([
            "title" => $request['title'],
            'slug' => $slug,
            "description" => $request['description'],
        ]);

        return response()->json("Article Created Successfully !");
    }
}
