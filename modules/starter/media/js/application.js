!function ($) {

  $(function(){
	$('pre').addClass('prettyprint linenums');
	$('table').addClass('table table-striped table-bordered');
    var $window = $(window)

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

    // make code pretty
    window.prettyPrint && prettyPrint()

  })

}(window.jQuery)
