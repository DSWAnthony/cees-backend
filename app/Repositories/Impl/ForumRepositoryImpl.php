<?php
namespace App\Repositories\Impl;

use App\Models\Forum;
use App\Repositories\Interfaces\ForumRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

class ForumRepositoryImpl implements ForumRepository{

    public function listAll():LengthAwarePaginator{
        return Forum::with(["course","createdBy"])->where("is_active",true)->paginate(15);
    }

    public function findById(int $id):Forum{
        $forum = $this->forumActive($id);
        return $forum->load(["course","createdBy"]);
    }

    public function create(array $data):Forum{
        return Forum::create($data)->load(["course","createdBy"]);
    }

    public function update(int $id , array $data):Forum{
        $forum = $this->forumActive($id);
        $forum->update($data);
        return $forum->load(["course","createdBy"]);
    }

    public function delete(int $id):bool{
        $forum_id = $this->forumActive($id);
        $forum_id->is_active=false;
        return $forum_id->save();
    }

    private function forumActive(int $id){
        $forum = Forum::findOrFail($id);
        if(!$forum->is_active) throw new InvalidArgumentException("El Forum con ID $id No Existe ó esta Eliminado");
        return $forum;
    }
}