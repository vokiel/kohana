<?php namespace Kohana;?>
<div class="container">
<section class="row">
		    <div class="page-header">
			    <h1>Kolor</h1>
		    </div>
<div class="input-append color" data-color="rgb(255, 146, 180)" data-color-format="rgb" id="cp3">
				<input type="text" class="span2" value="" readonly >
				<span class="add-on"><i style="background-color: rgb(255, 146, 180)"></i></span>
			</div>
</section>
<section class="row">
		    <div class="page-header">
			    <h1>Czas</h1>
		    </div>
<section class="input-append date" id="dp3" data-date="19-10-2012" data-date-format="dd-mm-yyyy" data-date-weekStart="1"><input  name="day"  size="16" type="text" value="19-10-2012" readonly><span class="add-on"><i class="icon-calendar"></i></span></section><section class="input-append bootstrap-timepicker-component"><input name="time" class=" timepicker-1 input-small" value="23:35:00" type="text" readonly><span class="add-on"><i class="icon-time"></i></span></section></section>
<section class="row">
		    <div class="page-header">
			    <h1>Edytor</h1>

		    </div>
<textarea class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>

</section>
<section class="row">
		    <div class="page-header">
			    <h1>jQuery Validate</h1>
		    </div>



					<form action="" id="contact-form" class="form-horizontal">
					  <fieldset>
					    <legend>Sample Contact Form <small>(will not submit any information)</small></legend>
					    <div class="control-group">
					      <label class="control-label" for="name">Your Name</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="name" id="name">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="email">Email Address</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="email" id="email">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="subject">Subject</label>
					      <div class="controls">
					        <input type="text" class="input-xlarge" name="subject" id="subject">
					      </div>
					    </div>
					    <div class="control-group">
					      <label class="control-label" for="message">Your Message</label>
					      <div class="controls">
					        <textarea class="input-xlarge" name="message" id="message" rows="3"></textarea>
					      </div>
					    </div>
              <div class="form-actions">
		            <button type="submit" class="btn btn-primary btn-large">Submit</button>
    			      <button class="btn">Cancel</button>
        			</div>
					  </fieldset>

			
			</section><!-- .row -->


</div> <!-- .container -->
