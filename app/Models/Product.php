<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];
    // public function scopeProductName($query){
    //     return $query->where('id',2);
    // }
    /**
     * The "booted" method of the model.
     *
     * @return void
    */
    // protected static function booted(){
    //     static::addGlobalScope(new ProductScope);
    // }
    protected static function booted()
    {
        static::addGlobalScope('product', function (Builder $builder) {
            $builder->where('id', 1);
        });
    }
    
}