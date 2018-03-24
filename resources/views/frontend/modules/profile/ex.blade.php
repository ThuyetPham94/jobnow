<div class="box-pience" id="ex_{!! $val->id !!}">
<div class="col-xs-12 det">
	<div class="company">{!! $val->CompanyName !!} <a href="javascript:void(0)" onclick="destroy({!! $val->id !!})" class="pull-right">{!! HTML::image('frontend/images/icon/delete-your-expience.png') !!}</a></div>
	<div class="position">{!! $val->PositionName !!}</div>
	<div class="description">{!! $val->Description !!}</div>
</div>
<div class="clearfix"></div>
</div>