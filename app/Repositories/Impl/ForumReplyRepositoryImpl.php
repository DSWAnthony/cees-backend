<?php
namespace App\Repositories\Impl;

use App\Models\ForumReply;
use App\Repositories\Interfaces\ForumReplyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumReplyRepositoryImpl implements ForumReplyRepository{

    public function listAll():LengthAwarePaginator{
        return ForumReply::with(["children","author"])
                            ->whereNull("parent_reply_id")
                            ->orderBy("created_at")
                            ->paginate(15);
    }

    public function findByIdTopic(int $idTopic):Collection{
        return ForumReply::with(["children","author"])
                            ->where("topic_id",$idTopic)
                            ->whereNull("parent_reply_id")
                            ->orderBy("created_at")
                            ->get();

    }

    public function create(array $data):ForumReply{
        return ForumReply::create($data)->load("author");
    }
    
    public function update(int $id , array $data):ForumReply{
        $replies = ForumReply::findOrFail($id);
        $replies->update($data);
        return $replies->load("author");
    }

    public function delete(int $id):bool{
        $replies = ForumReply::findOrFail($id);
        return $replies->delete();
    }


}