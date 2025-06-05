<?php

namespace App\Repositories\Impl;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class EventRepositoryImpl implements EventRepository{

    
    public function listAll():LengthAwarePaginator{
        return Event::with(["course","createdBy"])->where("is_active",true)->paginate(15);
    }

    public function findById(int $id):Event{
        $event = $this->eventActive($id);
        return $event->load(["course","createdBy"]);;
    }

    public function create(array $data):Event{
        return Event::create($data);
    }

    public function update(int $id,array $data):Event{
        $event = $this->eventActive($id);
        $event->update($data);
        return $event->load(["course","createdBy"]);
    }

    public function delete(int $id):bool{
         $event = $this->eventActive($id);
         $event->is_active=false;
         return $event->save();
    }

    private function eventActive(int $id){
        $event = Event::findOrFail($id);
        if(!$event->is_active) throw new InvalidArgumentException("El Evento con ID $id No Existe o Esta Eliminado");
        return $event;
    }

}