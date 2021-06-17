<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$post = Post::all();
        $post = Post::where('user_id',Auth::id()) //donde el user_id= id del usuario autenticado
                    ->orderBy('create_date','desc')
                    ->get(); //importante poner método get() Sino, no recuperará nada

        $comments = Post::find(1)->comments; //comments es el nombre de la funcion. Equivale a hacer un select en la tabla donde el id sea 1 y hacer join
        return  view('blog.index',compact('post', 'comments')); //Compact, es similiar a escribir toda la instruccion del arreglo asociativo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //renderizar la plantilla
        return view('blog.create'); //Dentro de las plantillas. resources/views/blog/create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //a traves de request tiene acceso a los campos del formulario
    {
        $post= new Post();
        $post->user_id=Auth::id();
        $post->title = $request->get("title");
        $post->content = $request->get("content");
        //$post->username = $request->get("username");
        //$post->image = $request->get("image");
        $post->create_date = date('Y-m-d');
        $post->update_date = date('Y-m-d');

        if($request->hasFile('image')){ //valida que el campo imagen tenga un archivo
            $image= $request->file('image'); //recuperar archivo. En la bd solo se almacena el nombre del archivo
            $filename = "img_".rand(1000, null).".".$image->getClientOriginalExtension(); //Generar nuevo nombre de archivo de imagen. Respeta extension original del archivo
            $post->image = $filename;
            Storage::disk('local')->putFileAs('public',$image, $filename); //FileAs permite definir nombre del archivo a crear en storage/app/public
        }
        $post->save();
        return redirect('blog')-> with('success', 'Post created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //renderizar la vista de plantilla de edición
        $post= Post::find($id);
        $user = Auth::user();

        /*Validacion con gates
        if(Gate::allows('update-post',$post)){
            return view('blog.edit',compact('post')); //compact equivalente a pasar el arreglo: (pasa el post que desea editar)
        }
        else{
            return view('access_denied');
        }*/

        if ($user->can('update', $post)) {
            return view('blog.edit',compact('post'));
        }
        else{
            return view('access_denied');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post=Post::find($id);

        if(Gate::allows('update-post',$post)){
            $post->user_id=Auth::id();
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            //$post->username = $request->get('username');
            //$post->image = $request->get('image');
            $post->update_date = date('Y-m-d h:i:sa');

            if($request->hasFile('image')){ //valida que el campo imagen tenga un archivo
                $image= $request->file('image'); //recuperar archivo. En la bd solo se almacena el nombre del archivo
                $filename = "img_".rand(1000, null).".".$image->getClientOriginalExtension(); //Generar nuevo nombre de archivo de imagen. Respeta extension original del archivo
                $post->image = $filename;
                Storage::disk('local')->putFileAs('public',$image, $filename); //FileAs permite definir nombre del archivo a crear en storage/app/public
            }
            $post->save();
            return redirect('blog')-> with('success', 'Post updated succesfully');
        }
        else{
            return view('access_denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);

        if(Gate::allows('delete-post',$post)){
            $post->delete();
            return redirect('blog')-> with('success', 'Post deleted succesfully');
        }
        else{
            return view('access_denied');
        }

    }

    public function json(){
        $data= [
            ["no" => 1 ,"name"=>"Carolina","age"=>21,"address" =>"Direccion 2", "email" => "carolina@gmail.com"],
            ["no" => 2 ,"name"=>"Eduardo","age"=>21,"address" =>"Direccion 3", "email" => "eduuuu@gmail.com"],
            ["no" => 3 ,"name"=>"Naomi","age"=>22,"address" =>"Lindavista", "email" => "naomi@gmail.com"],
            ["no" => 4 ,"name"=>"Carlos","age"=>24,"address" =>"Direccion 5", "email" => "carlos@gmail.com"],
            ["no" => 5 ,"name"=>"Maria","age"=>23,"address" =>"Direccion 6", "email" => "maria@gmail.com"],
        ];

        return response()->json($data, Response::HTTP_OK); //OK equivale a codigo 200 respuesta exitosa
    }

    public function datatable(){
        return view('blog.datatable');
    }

    public function datatable_data(){
        $posts = Post::all();
        return response()->json(['data' => $posts], Response::HTTP_OK);
    }

    public function datatable_comments($id){
        $comments = Comment::where("post_id","=",$id)->get();
        return response()->json(['data' => $comments], Response::HTTP_OK);
    }
}
