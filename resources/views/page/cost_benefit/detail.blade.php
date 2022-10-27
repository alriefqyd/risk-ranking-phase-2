<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->getCostBenefit(false))
        <div class="table-responsive js-table-cost-benefit">
            <input type="hidden" class="js-project-id" value="{{$project->id}}">
            <div class="row m-2 text-sm">
                <div class="col-md-2" style="margin-top: auto">Year</div>
                <div class="col-md-2">Initial and Sustaining CapEx <br/><span class="txt-danger">$US (x000)</span></div>
                <div class="col-md-2">Additional Revenue (positive) <br/><span class="txt-danger">$US (x000)</span></div>
                <div class="col-md-2">Incremental Operating costs (negative) <br/><span class="txt-danger">$US (x000)</span></div>
                <div class="col-md-2">Cost savings (positive if relevant) <br/><span class="txt-danger">$US (x000) </span></div>
                <div class="col-md-2" style="margin-top: auto">Net Incremental Benefits</div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped text-center">
                    <tbody class="js-table-body-cost-benefit">
                    @foreach($project->getCostBenefit(false) as $bc)
                        <tr data-id="1" style="text-align: left">
                            <td>
                                {{$bc['year']}}
                            </td>
                            <td>
                               {{$bc['initial_and_sustaining_capex']}}
                            </td>
                            <td>
                                {{$bc['additional_revenue']}}
                            </td>
                            <td>
                                {{$bc['increment_operating_cost']}}
                            </td>
                            <td>
                                {{$bc['cost_savings']}}
                            </td>
                            <td>
                                {{$bc['net_incremental_benefits']}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center">
            No Data Cost Benefit
        </div>
    @endif
</div>
