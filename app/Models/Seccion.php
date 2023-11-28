<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tema;
use App\Models\User;

class Seccion extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre_seccion','user_id'];
    protected $allowIncluded=['user','tema'];
    protected $allowFilter=['id','nombre_seccion','user_id'];
    protected $allowSort=['id','nombre_seccion','user_id'];


    public function scopeIncluded(Builder $query){
       
        if(empty($this->allowIncluded)||empty(request('included'))){
            return;
        }
        
        $relations = explode(',', request('included'));//['posts','relation2']
       
        $allowIncluded=collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']
    
        foreach($relations as $key => $relationship){//recorremos el array de relaciones
            
            if(!$allowIncluded->contains($relationship)){
                unset($relations[$key]);
            }
        
        }
      $query->with($relations);//se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included
     
    }
    //return $relations;
// return $this->allowIncluded;

///////////////////////////////////////////////////////////////////////////////////////////



    public function scopeFilter(Builder $query){

        
        if(empty($this->allowFilter)||empty(request('filter'))){
            return;
        }
        
        $filters =request('filter');
        $allowFilter= collect($this->allowFilter);

        foreach($filters as $filter => $value){

            if($allowFilter->contains($filter)){

                $query->where($filter,'LIKE', '%'.$value.'%');

        
            }

        }

        //http://api.learncartoon/v1/actividads?filter[name]=user&filter[id]=1

        }

    //////////////////////////////////////////////////////////////////////////////////

    public function scopeSort(Builder $query){

    
        if(empty($this->allowSort)||empty(request('sort'))){
            return;
        }
        
        
        $sortFields = explode(',', request('sort'));
        $allowSort= collect($this->allowSort);
    
        foreach($sortFields as $sortField ){
    
             if($allowSort->contains($sortField)){
    
                $query->orderBy($sortField,'asc');
         
            }
    
        }
    
         //http://api.learncartoon/v1/actividads?sort=name
        
    
        }


    // relacion de uno a muchos
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
   
    public function tema(){
        return $this->hasMany(Tema::class, 'seccion_id');
    }
    
    }
    