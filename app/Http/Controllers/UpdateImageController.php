<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFotoRequest;
use App\Models\Notebook;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UpdateImageController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFotoRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function updateImage(UpdateFotoRequest $request, $id): JsonResponse
    {


        try {

            $notebook = Notebook::findOrFail($id);
            if (file_exists($notebook->foto)) {
                unlink($notebook->foto);
            }

            if (Storage::exists($notebook->foto)) {
                Storage::delete($notebook->foto);
                Storage::disk('public')->delete($notebook->foto);
                app(FilesystemManager::class)->delete($notebook->foto);

            }

            $file = $request->file('foto');

            $imageName = time() . '.' . $file->extension();
            $imagePath = public_path() . '/storage/images';

            $file->move($imagePath, $imageName);
            $notebook->update([
                'foto' => 'storage/images/' . $imageName
            ]);


            return response()->json([
                "success" => true,
                "message" => "Notebook has been update successfully."
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Updated image false!8"
            ], 500);
        }


    }
}

