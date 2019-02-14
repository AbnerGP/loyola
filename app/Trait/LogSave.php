<?php
namespace App\Http\Traits;

trait LogSave
{
    use Activity;

    public function getAllRelations()
    {
        return $this->allRelations;
    }

    public function save(array $options = array()) {
        $changed = $this->isDirty() ? $this->getDirty() : false;

        $data_save = null;
        if(\Request::method() == 'PUT'){
            $modelEntity = __CLASS__;
            $data_save = serialize($modelEntity::find($this->id)->attributes);
        }
        parent::save();
        if($changed) {
            $this->activity(null, __CLASS__, $this->id, $data_save);
        }
    }

    public function delete($isRelationship = false) {
        $relations = $this->getAllRelations();

        $activities = [];

        if($isRelationship){
            $data_save = $this->attributesToArray();
            $data_save['relation'] = true;
            $activity = $this->activity('Se eliminó el elemento', __CLASS__, $this->id, serialize($data_save), 'DELETE');
            $activity = $activity->id;
        }

        if(isset($relations)){
            foreach ($relations as $relation){
                $model_relation = $this->$relation;
                foreach ($model_relation as $reg){
                    $activity = $reg->delete(true);
                    $activities[] = $activity;
                }
            }
        }

        if(! $isRelationship){
            $data_save = $this->attributesToArray();
            $activities = implode(",", $activities);
            $data_save['relation'] = $activities;
            $this->activity('Se eliminó el elemento', __CLASS__, $this->id, serialize($data_save), 'DELETE');
        }


        parent::delete();
        if(isset($activity)){
            return $activity;
        }
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}