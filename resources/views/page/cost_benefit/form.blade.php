<div class="table-responsive js-table-cost-benefit">
    <input type="hidden" class="js-project-id" value="{{$project->id}}">
    <div class="row m-2 text-sm">
        <div class="col-md-2" style="margin-top: auto">Year</div>
        <div class="col-md-2">Initial and Sustaining CapEx <br/><span class="txt-danger">$US (x000)</span></div>
        <div class="col-md-2">Additional Revenue (positive) <br/><span class="txt-danger">$US (x000)</span></div>
        <div class="col-md-2">Incremental Operating costs (negative) <br/><span class="txt-danger">$US (x000)</span></div>
        <div class="col-md-2">Cost savings (positive if relevant) <br/><span class="txt-danger">$US (x000) </span></div>
        <div class="col-md-2" style="margin-top: auto">Net Incremental Benefits <br/><span class="txt-danger">$US</span></div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped text-center">
            <tbody class="js-table-body-cost-benefit">
            @if($project?->getCostBenefit(false))
            @foreach($project?->getCostBenefit(false) as $bc)
                <tr data-id="1">
                    <td class="col-md-2">
                        <select name="year[]" class="form-select js-cost-benefit-year" style="width:100% !important;">
                            @for($i=2022;$i<2051;$i++)
                                <option {{$bc['year'] == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <input type="text" name="initial_and_sustaining_capex[]" value="{{$bc['initial_and_sustaining_capex']}}" class="form-control js-currency-format js-cost-benefit js-initial-and-sustaining">
                    </td>
                    <td>
                        <input type="text" name="additional_revenue[]" value="{{$bc['additional_revenue']}}" class="form-control js-cost-benefit js-currency-format js-additional-revenue">
                    </td>
                    <td>
                        <input type="text" name="increment_operating_cost[]" value="{{$bc['increment_operating_cost']}}" class="form-control js-currency-format js-cost-benefit js-increment-operating-cost">
                    </td>
                    <td>
                        <input type="text" name="cost_savings[]" value="{{$bc['cost_savings']}}" class="form-control js-currency-format js-cost-benefit js-cost-savings">
                    </td>
                    <td>
                        $ <input type="text" name="net_incremental_benefits[]" readonly="true" value="{{$bc['net_incremental_benefits']}}" class="form-control js-currency-format js-cost-benefit js-net-incremental-benefits">
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-2 float-end mt-3 m-r-0">
    <p class="alert-color-green js-add-new-cost-benefit alert-note">
        <i class="fa fa-plus-circle"></i>
        <span>Add new column</span>
    </p>
</div>
