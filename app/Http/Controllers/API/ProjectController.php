<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        //SINTAX INDEX 1
        return response()->json([
            //'success'=> 'true' => serve per far vedere all'utente che è andata a buon fine la chiamata
            'success' => 'true',
            //'results' => Project::orderByDesc('id')->paginate(5)
            //aggiungo il metodo with() per correlare anche type e technologies
            //i nomi sono gli stessi che ho dato ai rispettivi metodi all'interno del model project.php quando ho definito le relazioni)
            'results' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(6)
        ]);

        //SINTAX INDEX 2
        //return Project::orderByDesc('id')->get();

        //SINTAX INDEX 2 + paginate
        //return Project::orderByDesc('id')->paginate(5);
    }

    public function show($slug)
    {

        //dd($slug);
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        //dd($project);
        if ($project){
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Project Not Found'
            ]);
        }
    }
}
