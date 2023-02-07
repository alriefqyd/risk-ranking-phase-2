@inject('getSubBasket',App\Models\CapexInvestment::class)
<div class="col-md-4 js-checkbox-basket-list">
    <a class="mr-2 setting-primary-custom bg-draft">
        <i class="fa fa-gear text-white"></i>
    </a>
    <div class="mt-3 col-md-2 mb-2">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    <h6>{{$capexCategory[0]?->name}}</h6>
    <div class="form-group">
        @foreach($sustainingList as $sustaining)
            <div class="js-basket-list-detail">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-{{$sustaining->code}}"
                           data-id="{{$sustaining->id}}"
                           name="checkbox_basket"
                           value="{{$sustaining->id}}"
                           {{old('checkbox_basket') == $sustaining->id ? 'checked' : ''}}
                           {{$project?->basket == $sustaining?->id ? 'checked' : ''}}
                           class="js-checkbox-{{$sustaining->code}} js-checkbox-open-bucket"
                           type="checkbox">

                    <label for="checkbox-{{$sustaining->code}}">{{$sustaining->name}}</label>
                </div>
                <div class="m-l-25 m-b-0 js-sub-basket-list
                    @if(old('checkbox_basket'))
                        {{old('checkbox_basket') != $sustaining->id ? 'd-none' : ''}}
                    @else
                        {{$project?->basket != $sustaining?->id ? 'd-none' : ''}}
                    @endif
                ">
                    @foreach($getSubBasket?->where('parent_id','=',$sustaining?->id)->get() as $index => $subBasket)
                        <div class="row mt-1 mb-1">
                            <div class="col-md-3">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-{{$subBasket->code}}"
                                           data-id="{{$subBasket->id}}"
                                           data-idx="{{$index}}"
                                           name="checkbox_sub_basket"
                                           {!! old('checkbox_sub_basket') == $subBasket->id ? 'checked' : ''!!}
                                           {!! $project?->sub_basket == $subBasket->id ? 'checked' : ''!!}
                                           value="{{$subBasket->id}}"
                                           class="js-checkbox-{{$subBasket->code}}
                                               js-checkbox-sub-basket"
                                           type="checkbox">
                                    <label for="checkbox-{{$subBasket->code}}"></label>
                                </div>
                            </div>
                            <div class="col-md-9" style="margin-top: auto">
                                {{$subBasket->name}} - {!! old('checkbox_sub_basket') == $subBasket->id ? 'checked' : ''!!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="js-sub-basket-error">

                </div>
            </div>
        @endforeach
        <input type="hidden" class="js-hidden-sub-basket" value="{{$project?->sub_basket}}" name="sub_basket">
        <input type="hidden" class="js-hidden-basket" value="{{$project?->basket}}" name="basket">
    </div>
</div>
<div class="col-md-4 js-checkbox-basket-list">
    <a class="mr-2 setting-primary-custom bg-draft justify-content-md-center">
        <i class="fa fa-lightbulb-o text-white"></i>
    </a>
    <div class="mt-3 col-md-2 mb-2 justify-content-md-center">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    <h6>{{$capexCategory[1]?->name}}</h6>
    @foreach($randdList as $randd)
        <div class="checkbox checkbox-primary">
            <input id="checkbox-{{$randd->code}}"
                   data-id="{{$randd->id}}"
                   name="checkbox_basket"
                   value="{{$randd->id}}"
                   {{$project?->basket == $randd?->id ? 'checked' : ''}}
                   {{old('checkbox_basket') == $randd?->id ? 'checked' : ''}}
                   class="js-checkbox-margin js-checkbox-open-bucket"
                   type="checkbox">

            <label for="checkbox-{{$randd->code}}">{{$randd->name}}</label>
        </div>
    @endforeach
</div>
<div class="col-md-4 js-checkbox-basket-list">
    <a class="mr-2 setting-primary-custom bg-draft">
        <i class="fa fa-rocket text-white"></i>
    </a>
    <div class="mt-3 col-md-2 mb-2">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    <h6>{{$capexCategory[2]?->name}}</h6>
    @foreach($growthList as $growth)
        <div class="checkbox checkbox-primary">
            <input id="checkbox-{{$growth->code}}"
                   data-id="{{$growth->id}}"
                   name="checkbox_basket"
                   value="{{$growth->id}}"
                   {{$project?->basket == $growth?->id ? 'checked' : ''}}
                   {{old('checkbox_basket') == $growth?->id ? 'checked' : ''}}
                   class="js-checkbox-margin js-checkbox-open-bucket"
                   type="checkbox">

            <label for="checkbox-{{$growth->code}}">{{$growth->name}}</label>
        </div>
    @endforeach
</div>
