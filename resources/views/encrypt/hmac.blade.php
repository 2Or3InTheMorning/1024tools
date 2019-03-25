@extends('layouts/main')
@section('pageTitle', 'HMAC计算、HMAC-MD5、HMAC-SHA1、HMAC-SHA256、HMAC-SHA512在线计算')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>HMAC计算、HMAC-MD5、HMAC-SHA1、HMAC-SHA256、HMAC-SHA512在线计算</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
			<dt>相关工具:</dt>
			<dd><a href="{{URL::route('encrypt.hash')}}">Hash计算</a></dd>
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-10 col-md-8">
		<form action="{{URL::route('encrypt.hmac.post')}}" method="post">
			<div class="form-group clearfix">
				<label for="query" class="control-label">消息：</label>
				<samp>{!! Form::input('text', 'query', $query, ['class' => 'form-control', 'id' => 'query']) !!}</samp>
			</div>
			<div class="form-group clearfix">
				<label for="algo" class="control-label">算法：</label>
				{!! Form::select('algo', array_combine($algos, $algos), $algo, ['class' => 'form-control', 'id' => 'algo']) !!}
			</div>
			<div class="form-group clearfix">
				<label for="key" class="control-label">密钥：</label>
				<samp>{!! Form::input('text', 'key', $key, ['class' => 'form-control', 'id' => 'key']) !!}</samp>
			</div>
			<div class="checkbox checkbox_key_type" title="如果您输入的是进行了base64编码处理后的密钥，请勾选此项，否则不勾选">
				<label>
					{!! Form::checkbox('base64encodedkey', 1, $base64encodedkey) !!} base64格式密钥
				</label>
			</div>
			<div class="checkbox checkbox_key_type" title="如果您输入的是进行了hex编码的密钥，请勾选此项，否则不勾选">
				<label>
					{!! Form::checkbox('hexencodedkey', 1, $hexencodedkey) !!} hex格式密钥
				</label>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<button type="submit" class="btn btn-primary">计算</button>
			@if(isset($errors) && $errors->any())
			<p class="mt10 bg-danger">{{{$errors->first()}}}</p>
			@endif
			
			@if (isset($result))
			<div class="form-group mt10 clearfix">
				<label for="result" class="control-label">结果A：</label>
				<samp>{!! Form::textarea('result', $result, ['class' => 'form-control', 'id' => 'result', 'rows' => 2, 'spellcheck' => "false"]) !!}</samp>
			</div>
			<div class="form-group mt10 clearfix">
				<label for="result" class="control-label">结果A':（对上面的"结果A"进行Base64编码）</label>
				<samp>{!! Form::textarea('result', base64_encode($result), ['class' => 'form-control', 'id' => 'result_base64', 'rows' => 2, 'spellcheck' => "false"]) !!}</samp>
			</div>
			<div class="form-group mt10 clearfix">
				<label for="result" class="control-label">结果B:（HMAC计算返回原始二进制数据后进行Base64编码）</label>
				<samp>{!! Form::textarea('result', $rawResult, ['class' => 'form-control', 'id' => 'result_base64', 'rows' => 2, 'spellcheck' => "false"]) !!}</samp>
			</div>
			@endif
		</form>
	</div>
</div>

<div class="row">
	<div class="tips">
		<ol>
			<li>HMAC (Hash-based Message Authentication Code) 常用于接口签名验证</li>
			<li>支持的算法有 {{implode('、', $algos)}} </li>
		</ol>
	</div>
</div>

@section('footer')
<script type="text/javascript">
~function($) {
	$('.checkbox_key_type input').click(function() {
		if (this.checked) {
			$('.checkbox_key_type input').not(this).prop('checked', false);
		}
	});
}(jQuery)
</script>
@stop

@stop
