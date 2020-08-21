<?php
namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\City;
use App\Company;

class ProjectController
{

    public function getAllProjects(){
        $projects = Project::all();
        return $projects;
    }

    /* usar Query builder tiene mejores ventajas
    $projects = Project::where('is_active', 0)
                ->orderBy('name', 'asc')
                ->take(2)
                ->get();*/


    public function getLastProjects(){

       return $projects = Project::latest('project_id')->take(10)->get();
    }

    //por si no lo encuentra controlar el error
    public function findOrFail(){
        return Project::firstOrFail(1);
    }

    //primero o nada
    public function firstOrFail(){
        return Project::where('is_active','=',1)->firstOrFail();
    }
    
    public function insertProject() {
       /* $project = new Project;
        $project->city_id = 1;
        $project->company_id = 1;
        $project->user_id = 1;
        $project->name = 'Nombre del proyecto';
        $project->execution_date = '2020-04-30';
        $project->is_active = 1;
        $project->save();*/

        foreach (range(0, 30) as $number) {
            $user = new User;
            $user->name = "User - {$number}";
            $user->save();

            $company = new Company;
            $company->name = "Company - {$number}";
            $company->save();

            $city = new City;
            $city->name = "City - {$number}";
            $city->save();
        }
    
        return "Guardado";
    }

    //metodo para actualizar
    public function updateProject(){
        $project = Project::find(2);
        $project->name = 'proyecto tecnologia';
        $project->save();

        return "Actualizado";
    }

    //borrar todos los proyectos inactivos
    public function updateInactiveProject(){
         $projects = Project::where('is_activate',0)->update(['name' => 'Projecto inactivo']);

         return "Projectos Renombrados";
    }

    //eliminar registros
    public function deleteProject(){
        $project = Project::where('project_id','>',15)->delete();
        return "Registros eliminados";
    }

    //eliminar los ultimos 10 registros
    public function deleteTenProject(){
        $project = Project::where('id','<=',10)->delete();
        return "Registros eliminados";
    }

    //crear uno para cuando se envien de un formulario
}