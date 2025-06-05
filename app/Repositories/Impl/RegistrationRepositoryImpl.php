<?php
namespace App\Repositories\Impl;

use App\Models\Registration;
use App\Repositories\Interfaces\RegistrationRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class RegistrationRepositoryImpl implements RegistrationRepository{

    public function listAll():LengthAwarePaginator {
        return Registration::with(["course","student"])
                            ->where("is_active",true)
                            ->paginate(15);
    }

    public function findById(int $id):Registration{
        $registration = Registration::where("id",$id)
                        ->where("is_active",true)
                        ->first();

        if(!$registration) throw new InvalidArgumentException("La Inscripción con ID $id No Existe.");

        return $registration->load(["course","student"]);
    }
    
    public function create(array $data):Registration{
        $data["is_active"]=true;
        return Registration::create($data);
    }

    public function update(int $id, array $data):Registration{
        $registration = Registration::findOrFail($id);
        $registration->update($data);
        return $registration;
    }

    public function delete(int $id):bool{
        $registration = Registration::findOrFail($id);
        if(!$registration->is_active) throw new InvalidArgumentException("El Registro se encuentra Eliminado");

        $registration->is_active = false;
        return $registration->save();
    }
}