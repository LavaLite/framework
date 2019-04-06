<?php

namespace Litepie\Master;

use User;

class Master
{
    /**
     * $master object.
     */
    protected $master;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Master\Interfaces\MasterRepositoryInterface $master)
    {
        $this->master = $master;
    }

    /**
     * Returns count of master.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  0;
    }

    /**
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.master.gadget', $count = 10)
    {

        if (User::hasRole('user')) {
            $this->master->pushCriteria(new \Litepie\Litepie\Repositories\Criteria\MasterUserCriteria());
        }

        $master = $this->master->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('id', 'DESC')->take($count);
        })->all();

        return view('master::' . $view, compact('master'))->render();
    }
    /**
     * get options for parent_id 
     * @return [type] [description]
     */
    public function parents()
    {
        return  $this->master->selectparents();
    }
    /**
     * get options for various fields
     * @return [type] [description]
     */
    public function options($status)
    {
         
        $temp = [];
        $options = $this->master->scopeQuery(function ($query) use ($status) {
            return $query->where('type', $status)->orderBy('name', 'ASC');
        })->all();
        
        foreach ($options as $key => $value) {
            $temp[$value->name] = ucfirst($value->name);
        }
        
        return $temp;
    }
    
    public function caste($parent_id)
    {
         
        $temp = [];
        $options = $this->master->scopeQuery(function ($query) use ($parent_id) {
            return $query->where('parent_id', $parent_id)->orderBy('name', 'ASC');
        })->all();
        
        foreach ($options as $key => $value) {
            $temp[$value->name] = ucfirst($value->name);
        }
        
        return $temp;
    }

     public function suboption($id)
    {         
        $temp = [];
        $options = $this->master->scopeQuery(function ($query) use ($id) {
            return $query->where('parent_id', $id)->orderBy('name', 'ASC');
        })->all();
        foreach ($options as $key => $value) {
            $temp[$value->name] = ucfirst($value->name);
        }

        return $temp;
    }

    public function education_type()
   {
        $education = $this->master->education();
       return  $education;
   }
    public function occupation_type()
   {
        $occupation = $this->master->occupation();
       return  $occupation;
   }
   public function religion()
   {
        $religion = $this->master->religion();
       return  $religion;
   }

    public function joboptions($status)
    {
         return $options = $this->master->joboptions($status);
        // $options = $this->master->scopeQuery(function ($query) use ($status) {
        //     return $query->where('type', $status)->orderBy('name', 'ASC');
        // })->all();

        // foreach ($options as $key => $value) {
        //     $temp[$value->name] = ucfirst($value->name);
        // }

        // return $temp;
    }
   

   
}
