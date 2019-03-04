@extends('template.master')

@section('css')
<style>
	:root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,::after,::before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}h2{margin-top:0;margin-bottom:.5rem}strong{font-weight:bolder}small{font-size:80%}a{color:#007bff;text-decoration:none;background-color:transparent}button{border-radius:0}button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,input{overflow:visible}button{text-transform:none}[type=submit],button{-webkit-appearance:button}[type=submit]::-moz-focus-inner,button::-moz-focus-inner{padding:0;border-style:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}h2{margin-bottom:.5rem;font-weight:500;line-height:1.2}h2{font-size:2rem}small{font-size:80%;font-weight:400}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.col-md-8{position:relative;width:100%;padding-right:15px;padding-left:15px}@media (min-width:768px){.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.offset-md-2{margin-left:16.666667%}}.form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem}.form-control::-ms-expand{background-color:transparent;border:0}.form-control::-webkit-input-placeholder{color:#6c757d;opacity:1}.form-control::-moz-placeholder{color:#6c757d;opacity:1}.form-control:-ms-input-placeholder{color:#6c757d;opacity:1}.form-control::-ms-input-placeholder{color:#6c757d;opacity:1}.form-group{margin-bottom:1rem}.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem}.text-center{text-align:center!important}.text-white{color:#fff!important}body{background:linear-gradient(90deg,#d53369 0%,#daae51 100%);color:#fff;height:auto!important}.mt-100{margin-top:100px}.material-box{border:none;border-radius:50vh}.btn-white{border:solid 2px #fff;color:#fff;padding:5px 30px}.custom-link{color:#fff;text-decoration:underline}
</style>
{{--
<style>
	body{
		background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
		color:#fff;
		height: auto !important;
	}
	.mt-100{
		margin-top: 100px;
	}
	.material-box{
		border:none;
		border-radius: 50vh;
	}
	.btn-white{
		border: solid 2px #fff;
		color: #fff;
		padding: 5px 30px;
	}
	.btn-white:hover, .btn-white:focus{
		transition: all 0.2s;
		background: #fff;
		color: #000;
		box-shadow: 0 1px 5px 0 #000;
		outline: none;
	}
	.custom-link{
		color: #fff;
		text-decoration: underline;
	}
	.custom-link:hover{
		color: #fff;
	}
</style>
--}}
@stop

@section('content')
<h2>Generate <a href="https://www.jsdelivr.com/" class="custom-link" target="_blank" title="https://www.jsdelivr.com/">JSDelivr</a> CDN from github</h2>
<form action="#" method="post">
	<div class="form-group">
		<input type="text" class="form-control material-box text-center" name="url" id="url" placeholder="https://raw.githubusercontent.com/User/Repo/Version/File.js">
		<span class="text-white"><small><strong>Enter the raw github url for your file.</strong></small></span>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-white material-box" id="generate_button">Generate</button>
	</div>
	<div class="form-group generating_cdn" style="display: none;">
		<span class="text-white"><small><strong id="generating_message">Generating CDN url ...</strong></small></span>
	</div>
	<div class="generated_cdn" style="display: none;">
		<div class="form-group">
			<span class="text-white"><small><strong>Please copy the CDN url from below.</strong></small></span>
			<input type="text" class="form-control material-box text-center" id="cdn_url" value="">
		</div>
		<div class="form-group">
			<a href="javascript:;" class="btn btn-white material-box" id="share_button">Share</a>
		</div>
	</div>
</form>
@stop

@section('javascript')
<script>
	$(function()
	{
		var app = {
			init : function()
			{
				this.button = $('#generate_button');
				this.loader = $('.generating_cdn');
				this.message = $('#generating_message');

				this.button.on('click', function(e)
				{
					e.preventDefault();
					$url = $('#url').val();

					app.showLoading();
					app.requestCdn($url);
				});
			},
			showLoading : function()
			{
				this.button.attr('disabled', true);
				this.loader.fadeIn(1000);
			},
			hideLoading : function()
			{
				this.button.attr('disabled', false);
				this.loader.hide();
			},
			showMessage : function($message)
			{
				this.message.text($message);
				app.showLoading();
				window.setTimeout(function() { app.hideLoading(); }, 2000);
			},
			requestCdn : function($url)
			{
				if( !$url.match(/https:\/\/raw.githubusercontent.com\//i) ) 
				{
					app.showMessage('Invalid Raw Github URL.');
					return false;
				}
				$final_url = new URL($url);
				$final_url = $final_url.pathname.split('/').join('%yz').split('.').join('%ab');
				$final_url = btoa($final_url);

				$.get('{{ route('generate_cdn', ['url' => '']) }}/'+$final_url, function(data)
				{
					if (data.error == true)
					{
						app.showMessage('Invalid Raw Github URL.');
						return false;
					}

					$('#cdn_url').val(data.cdn_url);
					console.log(data.cdn_url);
					$('#share_button').blShare({
						theme:'light',
						customUrl: data.cdn_url
					});
				})
				.done(function() {
					app.hideLoading();
					$('.generated_cdn').fadeIn(500);
					$('#cdn_url').select().focus();
				})
				.fail(function() {
					app.showMessage('An error occurred.');
					return false;
				});
			}
		}
		app.init();
	});
</script>
@stop