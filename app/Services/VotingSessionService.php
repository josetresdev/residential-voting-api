<?php

namespace App\Services;

use App\Models\VotingSession;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;
use Illuminate\Support\Str;

class VotingSessionService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = VotingSession::orderByDesc('created_at');
        $votingSessions = Pagination::paginate($query);
        return $this->apiResponse->success($votingSessions);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['uuid'] = Str::uuid()->toString();

            $votingSession = VotingSession::create($data);

            return $this->apiResponse->success($votingSession, 'Voting session created successfully', 201);
        });
    }

    public function show($id)
    {
        $votingSession = VotingSession::find($id);

        if (!$votingSession) {
            return $this->apiResponse->error('Voting session not found', 404);
        }

        return $this->apiResponse->success($votingSession);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $votingSession = VotingSession::findOrFail($id);

            $votingSession->update($data);

            return $this->apiResponse->success($votingSession, 'Voting session updated successfully');
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $votingSession = VotingSession::findOrFail($id);
    
            $votingSession->delete();
    
            return $this->apiResponse->success(null, 'Voting session deleted successfully', 200);
        });
    }
    
}
