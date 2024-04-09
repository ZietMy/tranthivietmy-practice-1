<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
/**
 * @OA\Post(
 *     path="/api/posts",
 *     summary="Create a new post",
 *     description="Create a new post with the provided title and description",
 *     tags={"Post"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string", example="New Post Title"),
 *             @OA\Property(property="description", type="string", example="This is a new post description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json"
 *         )
 *     )
 * )
 */

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Get all posts",
     *     tags={"Post"},
     *     @OA\Response(response=200, description="All Post"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Get one posts",
     *     tags={"Post"},
     *          @OA\Parameter(
     *              name="id",
     *               in="path",
     *              description="Post ID",
     *              required=true,
     *              @OA\Schema(type="integer")
     *          ),
     *     @OA\Response(response=200, description="One Post"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
                    'title' => 'required|unique:post|min:5|max:50',
                    'description' => 'required|min:10|max:100',       
                ]);
        return Post::create($request->all());
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|unique:post|min:5|max:50',
    //         'description' => 'required|min:10|max:100',
    //     ]);

    //     $post = Post::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //     ]);

    //     return response()->json($post, 201);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Update post",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="New Post Title"),
     *                 @OA\Property(property="description", type="string", example="This is a new post description")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Update Post"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function update(Request $request, $id)
    {
         //
         $post = Post::findOrFail($id);
         $post->update($request->all());
         return $post;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Delete a specific post",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string", example="New Post Title"),
     *                 @OA\Property(property="description", type="string", example="This is a new post description")
     *             )
     *         )
     *     ),     
     *     @OA\Response(response=200, description="Delete Post"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return "Delete success";
    }
}
