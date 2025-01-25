@inject('getSubBasket',App\Models\CapexInvestment::class)
<div class="col-md-4 js-checkbox-basket-list">
   <label>Project Type</label>
    <div class="col-md-5 mb-2">
        <div style="height: 1px; background-color: #24695c "></div>
    </div>
    <div class="error mt-3 js-error-project-type"></div>
    @foreach($basketList as $b)
        <div class="js-basket-list-detail">
            <div class="checkbox checkbox-primary">
                <input id="checkbox-{{$b->code}}"
                       data-id="{{$b->id}}"
                       name="checkbox_basket"
                       data-url="/getSubBasetByBasket"
                       value="{{$b->id}}"
                       {{$project?->basket == $b?->id ? 'checked' : (isset($project) ? 'disabled' : '')}}
                       class="js-checkbox-{{$b->code}} js-checkbox-open-bucket"
                       type="checkbox">

                <label for="checkbox-{{$b->code}}">{{$b->name}}</label>
            </div>
        </div>
    @endforeach
</div>

<div class="col-md-4 js-checkbox-sub-basket-list">
    <label>Project Sub Type</label>
    <div class="col-md-5 mb-2">
        <div style="height: 1px; background-color: #24695c ">

        </div>
    </div>
    <div class="error mt-3 js-error-project-type"></div>
    <div class="js-checkbox-sub-basket-form" style="height: auto">
        <div class="col-md-4 js-checkbox-sub-basket-item position-auto">
            <div class="checkbox checkbox-primary ml-2 ">
                @foreach($subBasketList ?? [] as $sub)
                    <input id="checkbox-{{$sub->code}}"
                           data-id="{{$sub->id}}"
                           value="{{$sub->id}}"
                           name="checkbox_sub_basket"
                           class="js-checkbox-margin js-checkbox-open-sub-basket"
                           {{$sub->id == $project->sub_basket ? 'checked' : 'disabled'}}
                           type="checkbox">
                    <label for="checkbox-{{$sub->code}}">{{$sub->name}}<br></label>
                @endforeach
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="js-hidden-sub-basket" value="{{$project?->sub_basket}}" name="sub_basket">
<input type="hidden" class="js-hidden-basket" value="{{$project?->basket}}" name="basket">
<input type="hidden" class="js-hidden-sub_basket_categories" value="{{$project?->sub_basket_categories}}" name="sub_basket_categories">
