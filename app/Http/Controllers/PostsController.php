<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller {
    public function index() {

        return Post::orderBy( 'id', 'desc' )->get();
    }

    public function create() {
        //
    }

    public function store( Request $request ) {

        $this->validate( $request, [
            'title'       => 'required',
            'description' => 'required',
        ] );

        return Post::create( [
            'title'       => $request->title,
            'description' => $request->description,
            'slug'        => Str::slug( $request->title ),
        ] );
    }

    public function show( $id ) {
        //
    }

    public function edit( $id ) {

        return Post::findOrFail( $id );
    }

    public function update( Request $request ) {

        $this->validate( $request, [
            'title'       => 'required',
            'description' => 'required',
        ] );
        return Post::where( 'id', $request->id )->update( [
            'title'       => $request->title,
            'description' => $request->description,
            'slug'        => Str::slug( $request->title ),
        ] );
    }

    public function destroy( Request $request ) {

        $this->validate( $request, [
            'id' => 'required',
        ] );
        return Post::where( 'id', $request->id )->delete();
    }
}
