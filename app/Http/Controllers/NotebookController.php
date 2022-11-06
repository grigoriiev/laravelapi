<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use App\Http\Requests\NoteBooksRequest;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
        
            $notebooks = Notebook::all();

            return response()->json([
                'status' => true,
                'notebook' => $notebooks
            ], 200);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'notebook' =>"Notebook has been false."
            ], 500);
        }
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    /*@return \Illuminate\Http\Response*/
     function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteBooksRequest $request)
    {


   
        try {


            $file = $request->file('foto');
            $imageName = time().'.'.$file->extension();
            $imagePath = public_path(). '/storage/images';
    
            $f=$file->move($imagePath, $imageName);
    
            $data = Notebook::create([
            'fio'=>$request->input('fio'),
            'tel'=>$request->input('tel'),
            'email'=>$request->input('email'),
            'company'=>$request->input('company'),
            'date'=>$request->input('date'),
            'foto'=>'storage/images/'.$imageName
            ]);
    
    
        return response()->json([
            "success" => true,
            "message" => "Notebook has been store successfully id".$data->id."."
        ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Notebook has been store false "
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    try {

    $notebook=Notebook::findOrFail($id);

    return response()->json([
        'status' => true,
        'notebook' => $notebook
    ], 200);
   } catch (\Throwable $th) {

    return response()->json([
        "success" => false,
        "message" => "Notebook has been show false."
    ], 500);
   }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function edit(NoteBooksRequest $notebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function update(NoteBooksRequest  $request, $id)
    {
         
        try {

            $notebook=Notebook::findOrFail($id);
            $notebook->update([
            'fio'=>$request->input('fio'),
            'tel'=>$request->input('tel'),
            'email'=>$request->input('email'),
            'company'=>$request->input('company'),
            'date'=>$request->input('date'),
        ]);
    
            return response()->json([
                "success" => true,
                "message" => "Notebook has been update successfully."
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Notebook Updated false!"
            ], 500);
        }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
  //  public function destroy(Notebook $notebook,$id)
  public function destroy(Request $request, $id)
    {

        try {
            $notebook=Notebook::findOrFail($id);

            if(file_exists($notebook->foto)){
                 unlink($notebook->foto);
                }
 
              if(Storage::exists($notebook->foto)){
                 Storage::delete($notebook->foto);
                 Storage::disk('public')->delete($notebook->foto);
                  app(FilesystemManager::class)->delete($notebook->foto);   
  
                }

            $notebook->delete();
    
            return response()->json([
                'status' => true,
                'message' => "Notebook Deleted successfully!",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Notebook Deleted false!",
            ], 500);
        }
     
    }


}
