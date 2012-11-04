!function ($) {

  $(function(){
	$('#cp3').colorpicker();
	$('#dp3').datepicker().on('changeDate', function(ev){ $('#dp3').datepicker('hide'); });
	$('#dp3 > span.add-on').click(function(ev){ $('.bootstrap-timepicker.dropdown-menu').removeClass('open'); });
	$('.timepicker-1').timepicker({minuteStep: 1, showSeconds: true, defaultTime: "value" ,showInputs: false, disableFocus: true, showMeridian: false});
	$('.bootstrap-timepicker-component > span.add-on').click(function(ev){ $('.bootstrap-timepicker.dropdown-menu').addClass('open'); });
	$('.textarea').wysihtml5();
	$('#contact-form').validate({
	    rules: {
	      name: {
	        minlength: 2,
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      subject: {
	      	minlength: 2,
	        required: true
	      },
	      message: {
	        minlength: 2,
	        required: true
	      }
	    },
	    highlight: function(label) {
	    	$(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	  });
	$('pre').addClass('prettyprint linenums');
    var $window = $(window)

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

    // make code pretty
    window.prettyPrint && prettyPrint()

  })

}(window.jQuery)
