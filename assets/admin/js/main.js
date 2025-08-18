(function ($) {
 "use strict";

		/*--------------------------
		 Page Loader
		---------------------------- */	

		$(window).load(function() {
			$("#spinner-wrapper").fadeOut("slow");
		});


		/*--------------------------
		file input
		---------------------------- */	

		var btns = '<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file"><i class="glyphicon glyphicon-trash text-danger"></i></button>';

		$.fn.fileinput.defaults = {
			language: 'en',
			showCaption: true,
			showPreview: true,
			showRemove: true,
			showUpload: false, // <------ just set this from true to false
			showCancel: true,
			showUploadedThumbs: true,
			overwriteInitial: true,
			defaultPreviewContent: '<img src="assets/img/profile.png" alt="Gallery Image" style="display:block; margin: 0 auto; width: 30%;">',
			allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"],
			maxFileSize: 2500,
			otherActionButtons: btns
			// many more below
		};


		/*--------------------------
		 Selector
		---------------------------- */	

		$(".chosen")[0] && $(".chosen").chosen({
            width: "100%",
            allow_single_deselect: !0
        });
		/*--------------------------
		 auto-size Active Class
		---------------------------- */	
		$(".auto-size")[0] && autosize($(".auto-size"));
		/*--------------------------
		 Collapse Accordion Active Class
		---------------------------- */	
		$(".collapse")[0] && ($(".collapse").on("show.bs.collapse", function(e) {
            $(this).closest(".panel").find(".panel-heading").addClass("active")
        }), $(".collapse").on("hide.bs.collapse", function(e) {
            $(this).closest(".panel").find(".panel-heading").removeClass("active")
        }), $(".collapse.in").each(function() {
            $(this).closest(".panel").find(".panel-heading").addClass("active")
        }));
		/*----------------------------
		 jQuery tooltip
		------------------------------ */
		$('[data-toggle="tooltip"]').tooltip();
		/*--------------------------
		 popover
		---------------------------- */	
		$('[data-toggle="popover"]')[0] && $('[data-toggle="popover"]').popover();
		/*--------------------------
		 File Download
		---------------------------- */	
		$('.btn.dw-al-ft').on('click', function(e) {
			e.preventDefault();
		});
		/*--------------------------
		 Sidebar Left
		---------------------------- */	
		$('#sidebarCollapse').on('click', function () {
			 $('#sidebar').toggleClass('active');
			 
		 });
		$('#sidebarCollapse').on('click', function () {
			$("body").toggleClass("mini-navbar");
			SmoothlyMenu();
		});
		$('.menu-switcher-pro').on('click', function () {
			var button = $(this).find('i.nk-indicator');
			button.toggleClass('notika-menu-befores').toggleClass('notika-menu-after');
			
		});
		$('.menu-switcher-pro.fullscreenbtn').on('click', function () {
			var button = $(this).find('i.nk-indicator');
			button.toggleClass('notika-back').toggleClass('notika-next-pro');
		});
		/*--------------------------
		 Button BTN Left
		---------------------------- */	
		
		$(".nk-int-st")[0] && ($("body").on("focus", ".nk-int-st .form-control", function() {
            $(this).closest(".nk-int-st").addClass("nk-toggled")
        }), $("body").on("blur", ".form-control", function() {
            var p = $(this).closest(".form-group, .input-group"),
				i = p.find(".form-control").val();
				
				0 == i.length && $(this).closest(".nk-int-st").removeClass("nk-toggled")

        })), $(".fg-float")[0] && $(".fg-float .form-control").each(function() {
            var i = $(this).val();
            0 == !i.length && $(this).closest(".nk-int-st").addClass("nk-toggled")
        });
		/*--------------------------
		 mCustomScrollbar
		---------------------------- */	
		$(window).on("load",function(){
			$(".widgets-chat-scrollbar").mCustomScrollbar({
				setHeight:460,
				autoHideScrollbar: true,
				scrollbarPosition: "outside",
				theme:"light-1"
			});
			$(".notika-todo-scrollbar").mCustomScrollbar({
				setHeight:320,
				autoHideScrollbar: true,
				scrollbarPosition: "outside",
				theme:"light-1"
			});
			$(".comment-scrollbar").mCustomScrollbar({
				autoHideScrollbar: true,
				scrollbarPosition: "outside",
				theme:"light-1"
			});
		});
	/*----------------------------
	 jQuery MeanMenu
	------------------------------ */
	jQuery('nav#dropdown').meanmenu();
	
	/*----------------------------
	 wow js active
	------------------------------ */
	 new WOW().init();
	 
	/*----------------------------
	 owl active
	------------------------------ */  
	$("#owl-demo").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
	});

	/*----------------------------
	 price-slider active
	------------------------------ */  
	  $( "#slider-range" ).slider({
	   range: true,
	   min: 40,
	   max: 600,
	   values: [ 60, 570 ],
	   slide: function( event, ui ) {
		$( "#amount" ).val( "£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ] );
	   }
	  });
	  $( "#amount" ).val( "£" + $( "#slider-range" ).slider( "values", 0 ) +
	   " - £" + $( "#slider-range" ).slider( "values", 1 ) );  
	   
	/*--------------------------
	 scrollUp
	---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 	   

	
	/*--------------------------
	 Custom
	---------------------------- */	
	
	// add Profile modal btn clicked

	$("body").click(function(e) {

		if ($("#kvFileinputModal").is(":visible")) 
		{
			if(e.target == $("#kvFileinputModal")) 
			{
				$("#kvFileinputModal").modal("hide"); // hide if clicked outside the modal
			}
			$(this).on("click", "#kvFileinputModal .btn-close", function () {
				$("#kvFileinputModal").modal("hide"); // hide if clicked on close
			});
			$(this).on("click", ".kv-file-zoom", function () {
				// append bugged kvFileinputModal in body
				$('#kvFileinputModal').appendTo('body').modal('show');
				// scroll on top when zoom clicked
				$("html, body, div.modal, div.modal-content, div.modal-body").animate({
					scrollTop: '0'
				}, 100);
			});

			setTimeout(function() 
			{
				$('body').addClass('modal-open'); // if inner modal closded add class to body
			}, 400); //delay in miliseconds##1000=1second
		}

		if($("#kvFileinputModal .btn-close").attr("data-dismiss")){
			$("#kvFileinputModal .btn-close").removeAttr("data-dismiss"); // remove data-dismiss attribute
		}
	});

})(jQuery); 