<div class="row js-form-project-detail m-b-30 {{!$errors->any() ? '' : 'd-none'}}">
    @if($project?->getCostBenefit(false) != null)
        <div class="table-responsive js-table-cost-benefit">
            <input type="hidden" class="js-project-id" value="{{$project->id}}">
            <div class="table-responsive mt-3">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <td>
                                Year
                            </td>
                            <td>
                                Initial and Sustaining CapEx <br/><span class="txt-danger">$US (x000)</span>
                            </td>
                            <td>
                                Additional Revenue (positive) <br/><span class="txt-danger">$US (x000)</span>
                            </td>
                            <td>
                                Incremental Operating costs (negative) <br/><span class="txt-danger">$US (x000)</span>
                            </td>
                            <td>
                                Cost savings (positive if relevant) <br/><span class="txt-danger">$US (x000) </span>
                            </td>
                            <td>
                                Net Incremental Benefits <br/><span class="txt-danger">$US</span>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="js-table-body-cost-benefit">
                    @foreach($project?->getCostBenefit(false) as $bc)
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
