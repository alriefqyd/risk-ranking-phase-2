<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestSubmitProject extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLargeDataSubmission()
    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
        for ($i = 0; $i < 10; $i++){
            $data[] = [
                'project_name' => "Project Testing_${$i}_",
                'owner' => "TESTING",
                'sponsor' => "SPONSOR",
                'bc_presenter' => "Presenter",
                'created_by' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'finance_analyst' => 'Testing Finance',
                'sub_basket' => 15,
                'basket' => 4,
                'sub_basket_categories' => 21,
                'presented_year' => 2025,
                'operation_area' => 7,
                'sponsor_area' => 13,
                'maintenance_reps' => 'Testing',
                'operation_reps' => 'Testing Operation',
                'fel_123_project_ref' => 'Testing ',
                'investment_strategy' => '{"level1":"r_and_d_growth","level2":"r_and_d","level3":"innovation_and_technology"}'
            ];
        }

        $response = $this->post('/project', ['data' => $data]);
        $response->assertStatus(200);
    }
}

// create new CCC
// status => waiting for approve (0/5)
// if reject status => reject
// if approve all status => approve

// - user creator
// - not waiting for approval and approve

// - reject -> update
// status => reject -> waiting for approve (0/5)
