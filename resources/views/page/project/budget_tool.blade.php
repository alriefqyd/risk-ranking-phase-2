
<div class="row">
    <div class="col-md-3 m-l-40 m-t-15">
        <h6 class="font-roboto title">Prioritization Criteria</h6>
    </div>
</div>
<div class="row js-form-project-edit center-content p-4 mt-1 ">
    <div class="col-md-12">
        <div class="col-md-6">
            Basket : {{$project->baskets->name}}
        </div>
        <div class="col-md-9">
            Sub Basket : {{$project->subBaskets?->name}}
        </div>
        <div class="col-md-9">
            Categories : {{$project->categories?->name}}
        </div>
    </div>
    <form method="post" action="/budget-tool">
        @csrf
    <div class="col-md-12">
        <div class="table-responsive">
            <input type="hidden" name="projectId" value="{{$project->id}}"/>
            <table class="table table-striped">
                <thead>
                    <th>Criteria</th>
                    <th>Answer</th>
                </thead>
                <tbody>
                @php($size = sizeof($criterias))
                @foreach($criterias as $criteria)
                    <tr>
                        <td class="">
                            {{$criteria->title ?? ''}}
                            <input type="hidden" name="criteria_id[]" value="{{$criteria->id}}">
                        </td>
                        <td class="">
                            <select name="answer[]" data-placeholder="Select Answer" class="col-sm-12 select2 js-select-criteria-answer" style="width: 550px">
                                <option></option>
                                @foreach($criteria->getOptionQuestion() as $q)
                                    <option {{isset($criteria->pivot->answer) && $criteria->pivot->answer == $q['value'] ? 'selected' : ''}} value="{{$q['value']}}">{{$q['value']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if(auth()->user()->role !== 'Viewer')
            <button type="submit" class="btn btn-success js-btn-submit-criteria mt-3 float-end" disabled>Save</button>
        @endif

    </div>
    </form>
</div>
