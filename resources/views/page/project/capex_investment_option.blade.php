@inject('getSubBasket',App\Models\CapexInvestment::class)
@foreach($capexCategories as $capexCategory)
<div class="col-md-4 js-checkbox-basket-list">
    <a class="mr-2 setting-primary-custom bg-draft">
        <i class="fa fa-gear text-white"></i>
    </a>
    <div class="mt-3 col-md-2 mb-2">
        <div style="height: 3px; background-color: #24695c "></div>
    </div>
    <h6>{{$capexCategory->name}}</h6>
    <div class="form-group">
        @foreach($capexCategory->basket as $b)
            <div class="js-basket-list-detail">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-{{$b->code}}"
                           data-id="{{$b->id}}"
                           name="checkbox_basket"
                           value="{{$b->id}}"
                           {{old('checkbox_basket') == $b->id ? 'checked' : ''}}
                           {{$project?->basket == $b?->id ? 'checked' : ''}}
                           class="js-checkbox-{{$b->code}} js-checkbox-open-bucket"
                           type="checkbox">

                    <label for="checkbox-{{$b->code}}">{{$b->name}}</label>
                </div>
                <div class="m-l-25 m-b-0 js-sub-basket-list
                    @if(old('checkbox_basket'))
                        {{old('checkbox_basket') != $b->id ? 'd-none' : ''}}
                    @else
                        {{$project?->basket != $b?->id ? 'd-none' : ''}}
                    @endif
                ">
                    @foreach($b->subBasket as $index => $subBasket)
                        <div class="row mt-1 mb-1 js-sub-basket-item">
                            <div class="col-md-3" style="padding-right: 0; width: 20%">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-{{$subBasket->code}}"
                                           data-id="{{$subBasket->id}}"
                                           data-idx="{{$index}}"
                                           name="checkbox_sub_basket"
                                           {!! old('checkbox_sub_basket') == $subBasket->id ? 'checked' : ''!!}
                                           {!! $project?->sub_basket != $subBasket->id ? 'disabled' : 'checked' !!}
                                           value="{{$subBasket->id}}"
                                           class="js-checkbox-{{$subBasket->code}}
                                               js-checkbox-sub-basket"
                                           type="checkbox">
                                    <label for="checkbox-{{$subBasket->code}}"></label>
                                </div>
                            </div>
                            <div class="col-md-9" style="margin-top: 8px">
                                {{$subBasket->name}}
                                <div class="js-sub-basket-categories
                                    @if(old('checkbox_sub_basket'))
                                        {{old('checkbox_sub_basket') != $subBasket->id ? 'd-none' : ''}}
                                    @else
                                        {{$project?->sub_basket != $subBasket?->id ? 'd-none' : ''}}
                                    @endif">
                                    @foreach($subBasket->categories as $category)
                                        <div class="row mt-1 mb-1">
                                            <div class="col-md-3" style="padding-right: 0; width: 20%">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox-categories-{{$subBasket->name}}-{{$category->id}}"
                                                           data-id="{{$category->id}}"
                                                           data-idx="{{$loop->index}}"
                                                           name="checkbox_categories"
                                                           {!! old('checkbox_categories') == $category->id ? 'checked' : ''!!}
                                                           {!! $project?->sub_basket_categories == $category->id && $project->sub_basket == $subBasket->id ? 'checked' : 'disabled'!!}
                                                           value="{{$category->value}}"
                                                           class="js-checkbox-{{$category->id}}
                                                               js-checkbox-categories"
                                                           type="checkbox">
                                                    <label for="checkbox-categories-{{$subBasket->name}}-{{$category->id}}"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-9" style="margin-top: auto">
                                                {{$category->name}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="js-sub-basket-error">

                </div>
            </div>
        @endforeach
    </div>
</div>
@endforeach
<input type="hidden" class="js-hidden-sub-basket" value="{{$project?->sub_basket}}" name="sub_basket">
<input type="hidden" class="js-hidden-basket" value="{{$project?->basket}}" name="basket">
<input type="hidden" class="js-hidden-sub_basket_categories" value="{{$project?->sub_basket_categories}}" name="sub_basket_categories">
