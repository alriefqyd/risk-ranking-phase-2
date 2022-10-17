<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Setting;
use App\Service\ProjectService;
use App\Service\SettingService;
use App\Service\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $projectService = new ProjectService();
//        $settingService = new SettingService();
//        $userService = new UserService();

        $projectList = $projectService->getAllProject(true);
//        $department = Department::TYPE['department'];
//        $subDepartment = Department::TYPE['sub-department'];

//        $department = $projectService->getDepartment($department, null);
//        $subDepartment = $projectService->getDepartment($subDepartment, null);
//        $projectCategory = Setting::PROJECT_CATEGORY;
//        $bcStatus = \App\Models\Project::BC_STATUS;
//        $projectType = $settingService->getProjectType();
//        $isAdmin = $userService->isAdmin();

        sleep(1);
        return view('livewire.project',[
//            'projectList' => \App\Models\Project::search('project_name',$this->search)->paginate(10),
//            'department' => $department,
//            'subDepartment' => $subDepartment,
//            'projectCategory' => $projectCategory,
//            'projectType' => $projectType,
//            'isAdmin' => $isAdmin,
            'projectList' => $projectList
        ]);
    }
}
