<?php
namespace App\Repositories\Impl;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class ModuleRepositoryImpl implements ModuleRepository {

    public function all():LengthAwarePaginator{
        return Module::with("course")->paginate(15);
    }
    public function findById(int $id):?Module{
        return Module::findOrFail($id);
         
    }
    public function create(array $array):Module{
        return Module::create($array);
    }
    public function update(int $id, array $array):Module{
        $module = Module::findOrFail($id);
        $module->update($array);
        return  $module;
    }
    public function delete(int $id):bool{
        $module = Module::findOrFail($id);
        return $module->delete();
    }
}