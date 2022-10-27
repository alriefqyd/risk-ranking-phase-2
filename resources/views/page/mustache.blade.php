<script id="js-template-cost-benefit" type="x-tmpl-mustache">
<tr data-id="@{{ no }}">
    <td>
        <select name="year[]" class="form-select js-cost-benefit-year" style="width:100% !important;">
            @for($i=2022;$i<2051;$i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </td>
    <td>
        <input type="number" name="initial_and_sustaining_capex[]" class="form-control js-initial-and-sustaining">
    </td>
    <td>
        <input type="number" name="additional_revenue[]" class="form-control js-additional-revenue">
    </td>
    <td>
        <input type="number" name="increment_operating_cost[]" class="form-control js-increment-operating-cost">
    </td>
    <td>
        <input type="number" name="cost_savings[]" class="form-control js-cost-savings">
    </td>
    <td>
        <input type="number" name="net_incremental_benefits[]" class="form-control js-net-incremental-benefits">
    </td>
</tr>
</script>
