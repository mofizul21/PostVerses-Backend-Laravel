<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct() {
        // Apply 'auth:sanctum' middleware except for 'index' and 'show'
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Post::with('user')->latest()->get();
       // return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' =>  'required|max:255',
            'body'  =>  'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image file upload if it exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $filename, 'public');
            $fields['image'] = $imagePath;
        }
        $post = $request->user()->posts()->create($fields);

        return ['post' => $post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return ['post' => $post, 'user' => $post->user];
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {

        Gate::authorize('modify', $post);

        $fields = $request->validate([
            'title' =>  'required|max:255',
            'body'  =>  'required|max:500',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $filename, 'public');
            $fields['image'] = $imagePath;
        }

        $post->update($fields);

        return ['post' => $post];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post){
        Gate::authorize('modify', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return ['message' => 'Post has been deleted'];
    }

}
