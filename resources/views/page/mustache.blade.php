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
       @{{ #data }}
           <div class="col-md-4 js-checkbox-sub-basket-item position-auto">
                <div class="checkbox checkbox-primary ml-2 ">
                    <input id="checkbox-@{{ code }}"
                           data-id="@{{ id }}"
                           value="@{{ id }}"
                           name="checkbox_sub_basket"
                           class="js-checkbox-margin js-checkbox-open-sub-basket"
                           type="checkbox">
                    <label for="checkbox-@{{ code }}">@{{ name }}<br></label>
                </div>
            </div>
        @{{ /data }}
</script>

<script id="js-template-categories" type="x-tmpl-mustache">
       @{{ #data }}
           <div class="col-md-4 js-checkbox-categories-item position-auto">
                <div class="checkbox checkbox-primary ml-2 ">
                    <input id="checkbox-@{{ code }}"
                           data-id="@{{ id }}"
                           value="@{{ id }}"
                           class="js-checkbox-margin js-checkbox-open-categories"
                           type="checkbox">
                    <label for="checkbox-@{{ code }}">@{{ name }}<br></label>
                </div>
            </div>
        @{{ /data }}
</script>

<script id="js-template-schedule-fel3" type="x-tmpl-mustache">
    <tr data-idx="@{{ idx }}">
        <td class="w-25">
            <input class="form-control js-schedule-desc" name="schedule_desc[]">
        </td>
        <td>
            <input class="form-control js-schedule-start-date" type="date" name="schedule_start_date[]">
        </td>
        <td>
            <input class="form-control js-schedule-end-date" type="date" name="schedule_end_date[]">
        </td>
    </tr>
</script>

