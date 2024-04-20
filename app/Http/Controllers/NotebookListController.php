<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class NotebookListController extends Controller
{
    public function list(Request $request): JsonResponse
    {


        try {
            $notebookList = Notebook::paginate($request->input("limit"));
            return response()->json([
                'status' => true,
                'notebookList' => $notebookList
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'notebookList' => "Notebook has been false."
            ], 500);
        }


    }

}






