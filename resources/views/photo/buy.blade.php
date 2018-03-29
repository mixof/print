@extends('layouts.master')

@section('title') Buy "{{ $photo->title }}" @stop

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="page-header">
				<h2>Buy: {{ $photo->title }}</h2>
			</div>

			<p>Before proceeding with your purchase please confirm the following:</p>

			<table style="width: 100%;" cellspacing="10">
				<tr>
					<td>
						<h3>Checklist</h3>
					</td>
					<td style="width: 50px;">
						<center><strong>Yes</strong></center>
					</td>
				</tr>
				<tr>
					<td>
						Is the printer turned on?
					</td>
					<td>
						<center><input type="checkbox" name="agree[]" id="printer" value="1" class="agree" /></center>
					</td>
				</tr>
				<tr>
					<td>
						Is photo paper loaded into the printer and facing the right way?
					</td>
					<td>
						<center><input type="checkbox" name="agree[]" id="paper" value="1" class="agree" /></center>
					</td>
				</tr>
				<tr>
					<td>
						Does the printer have enough ink? (We recommend cartridge levels of at least 8%)
					</td>
					<td>
						<center><input type="checkbox" name="agree[]" id="ink" value="1" class="agree" /></center>
					</td>
				</tr>
			</table>
			
			<table style="float:left; clear:both; font-size:14px; width: 100%;" cellspacing="10">
				<tr>
					<td>
						<h3>Disclaimer</h3>
					</td>
					<td style="width: 50px;">
						<center><strong>I Agree</strong></center>
					</td>
				</tr>
				<tr>
					<td>
						Prinstantly.com is not responsible for any user-end interuption in printing such as power outage, paper jam, running out of ink, or mechanical problems.
					</td>
					<td>
						<center><input type="checkbox" name="agree[]" id="responsible" value="1" class="agree" /></center>
					</td>
				</tr>
				<tr>
					<td>
						This image is the sole copyright of the artist and may not be copied, reproduced, or distributed without permission.
					</td>
					<td>
						<center><input type="checkbox" name="agree[]" id="copyright" value="1" class="agree" /></center>
					</td>
				</tr>
			</table>
			
			<div id="continue">
				
                
                <a href="{{ URL::route('paypal', $photo->slug) }}" class="btn btn-primary pull-right"  disabled="disabled">Continue</a>
			</div>
		</div>
	</div>
@stop

@section('footer')
	<script type="text/javascript">
	$(function(){ 
		$('.agree').click(function(){
			var checked_num = $('input[name="agree[]"]:checked').length;
			
			if(checked_num == 5) {
				$('#continue .btn').attr('disabled', false);
			} else {
				$('#continue .btn').attr('disabled', true);
			}
		});
	});
	</script>
@stop