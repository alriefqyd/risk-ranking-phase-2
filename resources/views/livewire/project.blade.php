
{{--Temporary Not Used--}}
<span
    wire:poll 5s
    >
    <tbody>
        @foreach($projectList as $project)
            <tr>
                <td>
                    {!! $project->getBcStatus() !!}
                </td>
                <td>
                    {{$project->project_number ?: '-'}}
                </td>
                <td>
                    @can('update')
                        <a href="/project/{{$project->id}}/edit">
                            <p class="alert-color-green">{{$project->project_name}}</p>
                        </a>
                    @else
                        {{$project->project_name}}
                    @endcan

                </td>
                <td class="text-center">
                    {!! $project->getRelatedDataProjectAssessment() !!}
                </td>
                <td class="text-center">
                    {!! $project->getRelatedDataProjectFel1() !!}
                </td>
                <td class="text-center">
                    {!! $project->getRelatedDataProjectFel2() !!}
                </td>
                <td class="text-center">
                    {!! $project->getRelatedDataProjectFel3() !!}
                </td>
                <td class="text-center">
                    {!! $project->getRelatedDataProjectBusinessCase() !!}
                </td>
                <td>{{$project->owners->name}}</td>
                <td>{{$project->sponsors->name}}</td>
                <td>{{$project->getProjectCategory()}}</td>
                <td>{{$project->project_type}}</td>
                <td>
                    <a data-bs-toggle="modal"
                       class="modal-note"
                       data-original-title="test"
                       data-note="{{$project->note}}"
                       data-id="{{$project->id}}"
                       data-bs-target="#detail_note_project">
                        {!! $project->getNoteTemplateForm() !!}
                    </a>
                </td>
                <td>
                    <a data-bs-toggle="modal" data-original-title="test"
                       data-id="{{$project->id}}"
                       data-bs-target="#projectDelete">
            <span class="alert-note alert-color-red">
                 <x-feathericon-trash-2/>
            </span>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</span>
