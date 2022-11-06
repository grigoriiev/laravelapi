<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notebook;
use App\Http\Requests\NoteBooksRequest;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Storage;

class UpdateImageController extends Controller
{
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notebook  $notebook
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
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
          
               $file = $request->file('foto');
                    
               $imageName = time().'.'.$file->extension();
               $imagePath = public_path(). '/storage/images';
       
               $file->move($imagePath, $imageName);
               $notebook->update([
               'foto'=>'storage/images/'.$imageName
           ]);
            
    
           
          
            return response()->json([
                "success" => true,
                "message" => "Notebook has been update successfully."
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Updated image false!8"
            ], 500);
        }
        


    

    }
}

