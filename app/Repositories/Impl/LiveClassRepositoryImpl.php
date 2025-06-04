<?php
namespace App\Repositories\Impl;

use App\Models\LiveClass;
use App\Repositories\Interfaces\LiveClassRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class LiveClassRepositoryImpl implements LiveClassRepository{

    public function listAll():LengthAwarePaginator{
        return LiveClass::with("course")->where("is_active",true)->paginate(15);
    }

    public function listClassFuture():LengthAwarePaginator{
        return LiveClass::with("course")
            ->where("is_active",true)
            ->where("scheduled_datetime",">",now())
            ->orderBy("scheduled_datetime")
            ->paginate(15);
    }

    public function findById(int $id):LiveClass{
        $live_class = $this->findActive($id);
        return $live_class->load("course");
    }

    public function create(array $data):LiveClass{
        return LiveClass::create($data)->load("course");
    }

    public function update(int $id,array $data):LiveClass{
        $live_class = $this->findActive($id);
        $live_class->update($data);
        return $live_class->load("course");
    }

    public function delete(int $id):bool{
        $live_class = $this->findActive($id);
        $live_class->is_active=false;
        return $live_class->save();
    }

    private function findActive(int $id): LiveClass {   
        $liveClass = LiveClass::findOrFail($id);
        if (!$liveClass->is_active) throw new InvalidArgumentException("La Clase en Vivo con ID $id no existe o ha sido eliminada.");
        return $liveClass;
    }
}