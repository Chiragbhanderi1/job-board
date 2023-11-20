<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{ 
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','location','salary','description','experience','category'];
    public static array $experience = ['entry','intermediate','senior'] ;
    public static array $category = ['IT','Finance','Sales','Marketing'];

    public function scopeFilters(EloquentBuilder|QueryBuilder $query,array $filters): EloquentBuilder|QueryBuilder
    {
        return $query->when($filters['search'] ?? null,function($query ,$search){
            $query->where(function($query)use($search){
             $query->where("title","like","%". $search."%")
             ->orWhere("description","like","%".$search."%")
             ->orWhereHas("employer",function($query)use($search){
                $query->where("company_name","like","%". $search."%");
             });
            });
         })->when($filters['min_salary'] ?? null ,function($query,$min_salary){
             $query->where('salary','>=',$min_salary);
         })->when($filters['max_salary']?? null,function($query,$max_salary){
             $query->where('salary','<=',$max_salary);
         })->when($filters['experience']?? null,function($query,$experience){
             $query->where('experience',$experience);
         })->when($filters['category']?? null,function($query,$category){
             $query->where('category',$category);
         });
    }
    public function employer():BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
    public function jobApplications():HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    public function hasUserApplied(User|int|Authenticatable $user): bool
    {
        return $this->where('id',$this->id)
            ->whereHas(
                'jobApplications',
                fn($query) => $query->where('user_id',"=",$user->id ?? $user)
            )->exists();
    }
}
