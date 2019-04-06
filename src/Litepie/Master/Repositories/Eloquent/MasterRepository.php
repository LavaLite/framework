<?php

namespace Litepie\Master\Repositories\Eloquent;

use Litepie\Master\Interfaces\MasterRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class MasterRepository extends BaseRepository implements MasterRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('master.master.model.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('master.master.model.model');
    }
    /**
     * get options for parent_id
     * @return [type] [description]
     */
     public function selectparents()
   {

       return $this->model->where('parent_id', '=', 0)->pluck('name','id');
   }
   /**
    * to display values under specific option
    * @param  [type] $main_category [description]
    * @return [type]                [description]
    */
   public function options($religion)
    { 
        if(is_numeric($religion))
        {
            
            return $this->model->where('parent_id', $religion)->get();
        }
        else 
        {
         $religion = $this->model->where('name', 'like', '%'.$religion.'%')->first();
       
         return $this->model->where('parent_id', $religion['id'])->get(); 
        }
    }
    /**
    * To display states preferences of particular country
    * @param  [type] $country_id [description]
    * @return [type]             [description]
    */
    public function castspref($id)
    {
        foreach($id as $key)
        {
            $ids = $this->model->where('name',$key)->pluck('id');
            $subcast[$key] = $this->model->where('parent_id',$ids)->get()->toArray();
           
        }
        foreach($subcast as $key)
        {
            foreach($key as $flag)
            {
                $casts[] = array_merge($flag);
                
            }
        }
        return $casts;
    }
     /**
    * to get raasi of particular star
    * @param  [type] $main_category [description]
    * @return [type]                [description]
    */
   public function raasi($star)
    {
        return $this->model->where('id', $star)->get();
    }

    public function joboptions($status)
    {
        return $this->model->where('type', $status)->where('parent_id', 0)->pluck('name', 'id');
    }

     public function education()
   {

       return $this->model
       ->where('parent_id', '=', 0)
       ->where('type','=','education')
       ->pluck('name','id');
   }
   public function occupation()
   {

       return $this->model
       ->where('parent_id', '=', 0)
       ->where('type','=','occupation')
       ->pluck('name','id');
   }
   public function religion()
   {

       return $this->model
       ->where('parent_id', '=', 0)
       ->where('type','=','religion')
       ->pluck('name','id');
   }

}
