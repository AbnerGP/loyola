<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Activity as ActivityTrait;

class RestablecerController extends Controller
{
    use ActivityTrait;

    public function restablecer(Activity $activity)
    {
        //Área para los roles
        if($activity->entity == 'Silber\Bouncer\Database\Role'){
            if($activity->methodType == 'DELETE') {
                $data = unserialize($activity->data_save);
                $tableName = 'bouncer_roles';
                DB::table($tableName)->insert($data);
                $this->activity('Se creó elemento con Id: ' . $activity->id_entity, $activity->entity, $activity->id_entity, null, 'POST');
                $activity->delete();
            }else{
                $entity = $activity->entity::find($activity->id_entity);
                if($activity->methodType == 'POST') {
                    $this->activity('Se eliminó el elemento', $activity->entity, $activity->id_entity, serialize($entity->attributesToArray()), 'DELETE');
                    $entity->delete();
                    $activity->delete();
                }else{
                    $data = unserialize($activity->data_save);

                    $this->activity('Se modificó el elemento', $activity->entity, $activity->id_entity, serialize($entity->attributesToArray()), 'PUT');
                    foreach ($data as $key=>$value){
                        $entity->$key = $value;
                    }
                    $entity->save();
                    $activity->delete();
                }
            }
        }else{
            if($activity->methodType == 'DELETE') {
                $data = unserialize($activity->data_save);
                $relation = $data['relation'];
                unset($data['relation']);

                if($relation == '' || $relation != 1){
                    $tableName = $activity->entity::getTableName();
                    DB::table($tableName)->insert($data);
                    $this->activity('Se creó elemento con Id: ' . $activity->id_entity, $activity->entity, $activity->id_entity, null, 'POST');
                }

                if($relation != 1 && $relation != ''){
                    $relation = explode(',', $relation);
                    foreach ($relation as $value){
                        $act = Activity::find($value);
                        if($act->methodType == 'DELETE') {
                            $data_act = unserialize($act->data_save);
                            unset($data_act['relation']);

                            $tableName_act = $act->entity::getTableName();
                            DB::table($tableName_act)->insert($data_act);
                            $this->activity('Se creó elemento con Id: ' . $act->id_entity, $act->entity, $act->id_entity, null, 'POST');
                            $act->delete();
                        }
                    }
                }

                $activity->delete();
            }else{
                $entity = $activity->entity::find($activity->id_entity);
                if($activity->methodType == 'POST') {
                    $entity->delete();
                    $activity->delete();
                }else{
                    $data = unserialize($activity->data_save);

                    foreach ($data as $key=>$value){
                        $entity->$key = $value;
                    }
                    $entity->save();
                    $activity->delete();
                }
            }
        }

        return redirect()->route('activity');
    }
}
