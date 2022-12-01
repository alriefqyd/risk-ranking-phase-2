<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_project_store()
    {
        $admin = User::factory()->create(['role' => 'Administrator', 'department' => 8]);
        $dataArray = [
            'project_number' => 'SIDB000730607301296',
            'project_name' => 'Testing Project',
            'project_type' => 'Productive',
            'owner' => 4,
            'sponsor' => 29,
            'project_category' => 'replacement',
            'bc_presenter' => 'BC Presenter',
            'bc_status' => 'BC Status',
            'note' => 'Note p',
            'finance_analyst' => 'Finance Analyst',
            'basket' => 4,
            'sub_basket' => 15,
            'created_by' => 11,
        ];

        $response = $this->actingAs($admin)->post('project', $dataArray);
        $this->assertCount(1,Project::where('project_number','SIDB000730607301296')->get());
    }
}
