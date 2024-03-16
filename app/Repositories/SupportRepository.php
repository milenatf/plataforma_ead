<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getSupports(array $filters = [])
    {
        return $this->getUserAuth()
                    ->supports()
                    ->where(function($query) use ($filters) {
                        if( isset($filters['lesson']) ) {
                            $query->where('lesson_id', $filters['lesson']);
                        }

                        if( isset($filters['status']) ) {
                            $query->where('status', $filters['status']);
                        }

                        if( isset($filters['filter']) ) {
                            $query->where('description', 'LIKE', "%{$filters['filter']}%");
                        }
                    })
                    ->get();
    }

    public function getSupport(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }

    public function createNewSupport(array $data): Support
    {
        return $this->getUserAuth()
                    ->supports()
                    ->create([
                        'lesson_id' => $data['lesson'],
                        'description' => $data['description'],
                        'status' => $data['status'],
                    ]);
    }

    public function createReplyToSupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
                ->replies()
                ->create([
                    'description' => $data['description'],
                    'user_id' => $user->id,
                ]);
    }

    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }
}