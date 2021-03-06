/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      
      var checkDiv = $('.modal-body p');
      if (checkDiv.attr("id") == "form_success") {
        	$("#book-modal").modal('show');
      }
    }
      
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
      //Call fitVids on homepage
      $('.vid-home').fitVids();
      $('.testimonial-container').flexslider({
    animation: "slide"
      });
      
    }
  },
   //Media page
  media: {
    init: function() {
      $('.vid-container').fitVids();
      $('.slider').flexslider({
      animation: "slide",
      controlNav: false
  });
      //Colorbox

  $( '.swipebox' ).swipebox();
    }
  },
  // About us page, note the change from about-us to about_us.
  about: {
    init: function() {
      // JavaScript to be fired on the about us page

      //toggle commpressed faqs
      $('.faq-list li').click(function(){
        $(this).toggleClass('compressed');
      });
    }
  },
  
// Testimonials page.
  testimonials: {
    init: function() {
      // JavaScript to be fired on the testimonials page

      var container = document.querySelector('.masonry');
      var msnry = new Masonry( container, {
	      // options
	      columnWidth: container.querySelector('.col-sm-6'),
	      itemSelector: '.col-sm-6'
	  });


    }
  },

// Songlist page.
  songlist: {
    init: function() {
      // JavaScript to be fired on the testimonials page

      $('#filters a').click(function (e) {
	      e.preventDefault()
	      $(this).tab('show')
	   })

    }
  },  

 
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

