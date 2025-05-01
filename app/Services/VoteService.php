<?php

namespace App\Services;

use App\Models\Vote;
use App\Utils\ApiResponse;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoteService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = Vote::with(['user', 'option', 'votingSession'])->orderByDesc('created_at');
        $votes = Pagination::paginate($query);
        return $this->apiResponse->success($votes);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $existingVote = Vote::where('user_id', $data['user_id'])
                ->where('voting_session_id', $data['voting_session_id'])
                ->first();

            if ($existingVote) {
                $existingVote->update(['option_id' => $data['option_id']]);
                return $this->apiResponse->success($existingVote, 'Vote updated successfully');
            }

            $data['uuid'] = Str::uuid()->toString();
            $vote = Vote::create($data);

            return $this->apiResponse->success($vote, 'Vote created successfully', 201); // Retornamos la respuesta con el voto creado
        });
    }

    public function show($id)
    {
        $vote = Vote::with(['user', 'option', 'votingSession'])->find($id);

        if (!$vote) {
            return $this->apiResponse->error('Vote not found', 404);
        }

        return $this->apiResponse->success($vote);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $vote = Vote::findOrFail($id);

            $vote->update($data);

            return $this->apiResponse->success($vote, 'Vote updated successfully');
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $vote = Vote::findOrFail($id);
            $vote->delete();

            return $this->apiResponse->success(null, 'Vote deleted successfully', 200);
        });
    }
}
