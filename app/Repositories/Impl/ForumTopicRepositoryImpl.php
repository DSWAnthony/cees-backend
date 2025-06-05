<?php
namespace App\Repositories\Impl;

use App\Models\ForumTopic;
use App\Repositories\Interfaces\ForumTopicRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumTopicRepositoryImpl implements ForumTopicRepository{

    public function listAll():LengthAwarePaginator{
        return ForumTopic::with(["forum","author"])->paginate(15);
    }
    public function findById(int $id):ForumTopic{
        $forum_topic = ForumTopic::findOrFail($id);
        return $forum_topic->load(["forum","author"]);
    }
    public function create(array $data):ForumTopic{
        return ForumTopic::create($data)->load(["forum","author"]);
    }
    public function update(int $id , array $data):ForumTopic{
        $forum_topic = ForumTopic::findOrFail($id);
        $forum_topic->update($data);
        return $forum_topic->load(["forum","author"]);
    }
    public function delete(int $id):bool{
        $forum_topic = ForumTopic::findOrFail($id);
        return $forum_topic->delete();
    }


}
