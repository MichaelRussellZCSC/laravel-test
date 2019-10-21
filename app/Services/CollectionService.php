<?php

namespace App\Services;

class CollectionService
{
    public function getTopCollectionsForUser($user_id, $limit = 10)
    {
        return \App\User::find($user_id)
            ->collections()
            ->limit($limit)
            ->get();
    }
}