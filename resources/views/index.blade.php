@extends('template.master')

@section('css')
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