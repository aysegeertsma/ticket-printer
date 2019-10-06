<?php

namespace App\Http\Controllers;

use Atlassian\JiraRest\Requests\Agile\Parameters\IssuesParameters;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrintController extends Controller
{
    public function tickets(int $sprintId)
    {
//        echo QrCode::format('svg')->generate('Make me a QrCode with special symbols ♠♥!!');
//        return;
        $request = new \Atlassian\JiraRest\Requests\Agile\Sprint\SprintRequest();

        $response = $request->issues($sprintId);


        $body = (json_decode($response->getBody()));

        $issues = [];



        foreach($body->issues as $issue) {

//            var_dump($issue); return;


            $issues[] = [
                'key' => $issue->key,
                'epic' => isset($issue->fields->epic)?trim($issue->fields->epic->name):'',
                'points' => (float) $issue->fields->customfield_10004,
                'description' => str_replace(
                    ['/','\\'],
                    ['&#8203;/','&#8203;\\'],
                    $issue->fields->summary
                ),
            ];

        }

        return view('print', ['issues'=>$issues]);
    }

    public function sprints()
    {

    }

}
