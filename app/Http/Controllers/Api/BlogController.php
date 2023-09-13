<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogLikes;
use App\Http\Resources\BlogPaginationResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $query = Blog::with('likes');
        if($request->search){
            $query->where('title','LIKE','%'.$request->search.'%');
            $query->orWhere('description','LIKE','%'.$request->search.'%');
        }
        if($request->filter == 'most_liked'){

        }else{
            $query->orderBy('id','desc');
        }
        
        $blogs = $query->paginate(15);
        // echo "<pre>";print_r(new BlogResource($blogs));echo "<pre>";
        
        return response()->json([
            'success' => true,
            'message' => 'Blog(s) retrieved successfully',
            'blog' => new BlogPaginationResource($blogs)
            // 'blog' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
         $validateBlog = Validator::make($request->all(), 
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            ]);

         if($validateBlog->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateBlog->errors()
            ], 404);
        }

        $input['title'] = $request->title;
        $input['description'] = $request->description;
        if($request->image){
            $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('product_images'), $fileName);
            $input['image'] = $fileName;    
        }

        $blog = Blog::create($input);
         
        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'blog' => $blog
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function likeBlog(Request $request,$id){
         $blog=Blog::find($id);

         $is_exist = BlogLikes::where('user_id',$request->user()->id)->where('blog_id',$id)->first();
         if(empty($is_exist)){
             $blogLikes = new BlogLikes();
             $blogLikes->blog_id = $id;
             $blogLikes->user_id = $request->user()->id;
             
             $blog->likes()->save($blogLikes);

         }else{
            BlogLikes::where('user_id',$request->user()->id)->where('blog_id',$id)->delete();
         }
         $blog = Blog::with('likes')->where('id',$id)->first();

         return response()->json([
                'success' => true,
                'message' => 'Blog updated successfully',
                'blog' => $blog
            ]);
         
    }
}
