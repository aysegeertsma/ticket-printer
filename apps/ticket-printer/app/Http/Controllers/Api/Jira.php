<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class Jira extends Controller
{

    public function getBoards(): JsonResponse
    {
        $request = new \Atlassian\JiraRest\Requests\Agile\Board\BoardRequest();
        $response = $request->all();
        $body = json_decode($response->getBody());

        $response = [];
        foreach($body->values as $record) {
            $response[] = [
                'id' => $record->id,
                'name' => $record->name,
                'url' => $record->self,
            ];
        }

        return response()->json($response);
    }

    public function getSprints(int $boardId): JsonResponse
    {
        $request = new \Atlassian\JiraRest\Requests\Agile\Board\BoardRequest();
        $response = $request->sprints($boardId);
        $body = json_decode($response->getBody());

        $response = [];
        foreach($body->values as $record) {
            $response[] = [
                'id' => $record->id,
                'name' => $record->name,
                'goal' => @$record->goal,
                'url' => $record->self,
            ];
        }

        return response()->json($response);
    }

    public function getIssues(int $sprintId): JsonResponse
    {
        $request = new \Atlassian\JiraRest\Requests\Agile\Sprint\SprintRequest();
        $response = $request->issues($sprintId);
        $body = json_decode($response->getBody());

        $response = [];
        foreach ($body->issues as $issue) {

            $response[] = [
                'key' => $issue->key,
                'epic' => $this->epicFromIssue($issue),
                'points' => (float) $issue->fields->customfield_10004,
                'description' => $this->formatDescription($issue->fields->summary),
            ];
        }

        return response()->json($response);
    }

    private function epicFromIssue($issue): string
    {
        $epic = '';
        if (isset($issue->fields->epic)) {
            $epic = trim($issue->fields->epic->name);
        }

        return $epic;
    }

    private function formatDescription(string $description): string
    {
        return str_replace(
            ['/', '\\'],
            ['&#8203;/', '&#8203;\\'],
            $description
        );
    }
}
