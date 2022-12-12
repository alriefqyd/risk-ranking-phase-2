<script id="js-template-cost-benefit" type="x-tmpl-mustache">
<tr data-id="@{{ no }}">
    <td style="width:160px">
        <select name="year[]" class="form-select js-cost-benefit-year" style="width:100% !important;">
            @for($i=2022;$i<2051;$i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </td>
    <td>
        <input type="text" name="initial_and_sustaining_capex[]" class="form-control js-cost-benefit js-currency-format js-initial-and-sustaining">
    </td>
    <td>
        <input type="text" name="additional_revenue[]" class="form-control js-cost-benefit js-additional-revenue">
    </td>
    <td>
        <input type="text" name="increment_operating_cost[]" class="form-control js-cost-benefit js-increment-operating-cost">
    </td>
    <td>
        <input type="text" name="cost_savings[]" class="form-control js-cost-benefit js-cost-savings">
    </td>
    <td>
        <input type="text" readonly="true" name="net_incremental_benefits[]" class="form-control js-cost-benefit js-net-incremental-benefits">
    </td>
</tr>
</script>
<script id="js-template-capex-investment" type="x-tmpl-mustache">

    <div class="checkbox checkbox-primary">
        <input id="checkbox-"
               data-id=""
               class="js-checkbox-margin js-checkbox-open-bucket"
               type="checkbox">
        <label for="checkbox-"></label>
    </div>

</script>
