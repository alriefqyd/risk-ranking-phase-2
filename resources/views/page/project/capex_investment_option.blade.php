@inject('getSubBasket',App\Models\CapexInvestment::class)
<div class="col-md-4 js-checkbox-basket-list">
   <h6>Project Type</h6>
    <div class="col-md-5 mb-2">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    @foreach($basketList as $b)
        <div class="js-basket-list-detail">
            <div class="checkbox checkbox-primary">
                <input id="checkbox-{{$b->code}}"
                       data-id="{{$b->id}}"
                       name="checkbox_basket"
                       data-url="/getSubBasetByBasket"
                       value="{{$b->id}}"
                       {{$project?->basket == $b?->id ? 'checked' : ''}}
                       class="js-checkbox-{{$b->code}} js-checkbox-open-bucket"
                       type="checkbox">

                <label for="checkbox-{{$b->code}}">{{$b->name}}</label>
            </div>
        </div>
    @endforeach
</div>

<div class="col-md-4 js-checkbox-sub-basket-list">
    <h6>Project Sub Type</h6>
    <div class="col-md-5 mb-2">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    <div class="js-checkbox-sub-basket-form" style="height: auto">

    </div>
</div>
<input type="hidden" class="js-hidden-sub-basket" value="{{$project?->sub_basket}}" name="sub_basket">
<input type="hidden" class="js-hidden-basket" value="{{$project?->basket}}" name="basket">
<input type="hidden" class="js-hidden-sub_basket_categories" value="{{$project?->sub_basket_categories}}" name="sub_basket_categories">
