/*non jQ*/
function loaderscreen(e){

	if(e == 'show') {
		loaderscreen_overlay = document.createElement("div");
		loaderscreen_overlay.id = 'overlay_loader';
		document.body.insertBefore(loaderscreen_overlay,document.body.childNodes[0]);
	} else if(e == 'hide') {

		var loaderscreen_overlay = document.getElementById('overlay_loader');
		loaderscreen_overlay.parentNode.removeChild(loaderscreen_overlay);
	}

}

/*non jQ*/

(function ($) {

	/!* selection kategori untuk search bar atas */
	$.fn.searchCatSelector = function(){
		var obj = $(this);	var catdisplay = $('#dummy' , this);	var catlist = $('#dropdown' , this);	var textinput = $('#searchinput-text' , this);	var konten = '';

		catlist.on('change' , function(){
			$( 'option:selected' , catlist ).each(function() {  konten = $( this ).text(); });
				catdisplay.empty().html(konten).promise().done(function(){
				var selWidth = catdisplay.width(); catlist.width(selWidth);
				});
			});

		 textinput.on('focusin' , function(){ 	obj.addClass('focused');	 });
		 textinput.on('focusout' , function(){ 	obj.removeClass('focused');	 });

	};

	/!* expand dan close untuk halaman dashboard*/
	$.fn.dashPanelExpand = function(){
		this.each(function(){
			var obj = $(this);
			var slideContent = $('.roll-content' , obj);
			var trigger = $('.trigger' ,obj );
			trigger.on('click' , function(){
				slideContent.slideToggle(200, function(){ 	 obj.toggleClass('opened'); });
			});
		});
	};

	/!* tab display system */
	$.fn.tabDisplay = function(){
		this.each(function(){
			var obj = $(this);
			var trigger = $('.tab-trigger' , this);
			var konten = $('.display-list' , this);

			trigger.on('click' , function(){
				var target = $(this).attr('rel');
				trigger.removeClass('on');	$(this).addClass('on');
				konten.hide();	$('#'+target , obj).show();
			});
		});
	};

	/!* PRODUCT PAGE GALLERY*/
	$.fn.prodGallery = function(){

		this.each(function(){
			var obj = $(this);
			var thumb_trigger = $('.trigger' , this);
			var nav_trigger = $('.nav' ,this);
			var preloader = $('.preloader' , this);
			var target = $('.big-image' , this);
			var state = 1;

			function changeImg(i , t){

				target.addClass('loading');

				$('.img' , target).attr('src', i) .load(function() {	target.removeClass('loading');	});

				thumb_trigger.removeClass('on');
				t.addClass('on');

			}

			thumb_trigger.on('click' , function(){
				var posisi = (($(this).parent('.list').index())+1);
				var url_img = $(this).attr('rel');
				var thumb_target = $(this);
				changeImg(url_img , thumb_target);

				state = posisi;
			});


		});

	};

	/!*pilih seller*/
	$.fn.selectSeller = function(){

		this.each(function(){

			var trigger = $('.selection' , this);

			trigger.on('click' , function(){
				trigger.removeClass('selected');
				$(this).addClass('selected');
			});

		});

	};

	/!*jumlah beli barang*/
	$.fn.spinnerIndex = function(){

		this.each(function(){

			var trigger = $('.trigger' , this);
			var input = $('.index' , this);

			trigger.on("click", function() {

			  	var method = $(this).attr('rel');
			  	var oldValue = input.val();

			  	if (method == 'plus') {
				  var newVal = parseFloat(oldValue) + 1;
				}

				else if (method == 'min'){
				    if (oldValue > 0) { newVal = parseFloat(oldValue) - 1; }
				    else {  newVal = 0; }
			  	}

			  	input.val(newVal);

			});
		});

	};

	$.fn.expandDropdown = function(){



		this.each(function(){

			var trigger = $(this);

			trigger.on('click', function(e) {
				e.stopPropagation();


			    var targetexpand = $('#'+($(this).attr('rel')));

			    targetexpand.toggle();

			    $(document).one('click', function (e) {
			        if(!$(e.target).is(trigger)) {
			            targetexpand.hide();
			        }
			    });


			});

		});



	}

	$.fn.pageDarking = function(){

		var pagedarker = $('#pagedarkoverlay');

		this.each(function(trigger){

			var obj = $(this);

			obj.hover( function(){

				pagedarker.show().animate({
					'opacity' : 1,

				},100);


			} , function(){
				pagedarker.hide().css('opacity' , 0);

			});

		});
	}

	$.fn.alertModal = function(){

		var pagedarker = $('#pagedarkoverlay');
		this.each(function(){
			$(this).on('click' , function(e){
				e.preventDefault();

				var title = $(this).attr('data-alert-title');
				var content = $('#'+($(this).attr('data-alert-content'))).html();

				var alertmodule = 	'<div id="alertbox">'
										+'<div class="alertmodal">'
			            					+'<div class="titlebar">'
			                					+title+'<a class="sprite removeprod closemodal closetrigger" href="javascript:void(0);"></a>'
			            					+'</div>'
			           						+'<div class="content">'
			           							+content
								            +'</div>'
								        +'</div>'
								        +'<div id="modaloverlay" class="modaloverlay"></div>'
								    +'</div>';

				$('body').prepend(alertmodule).promise().done(function(){
					var alertbox = $('#alertbox');
					var overlay = $('#modaloverlay' , alertbox);
					var closetrigger = $('.closetrigger' , alertbox);

					closetrigger.add(overlay).one('click', function (e) {
				            alertbox.remove();
				    });

				});

			});
		});


	}

	$.fn.mobileSlideMenu = function(){

		this.each(function(){

			var trigger = $('#mobileslideTrigger' , this);
			var menumodule = $('#menumodule' , this);
			var overlay = $('#slidemenuoverlay' , this);
			var slidemod = $('#slidemodule' , this);
			var maincat_trigger = $('.main.link' , this);
			var catslide = $('#slidemenu' , this);
			var backslide_trigger = $('.back.link' , this);
			var submenu = $('.subcat' , this);

			function init(m){
				if(m == 'expand'){
					menumodule.show();
					slidemod.animate({
						'left' : '0',
					});
					overlay.fadeIn();

				}

				else if(m == 'close'){


					slidemod.animate({
						'left' : '-300px',
					} , function(){

						menumodule.hide();
					});
					overlay.fadeOut();

				}

			}

			function expandInit(m , c){
				if(m == 'expand') {
					c.show();
					catslide.animate({
						'left' : '-250px',
					});
				}

				else if(m = 'back'){
					catslide.animate({
						'left' : '0',
					} , function(){
						submenu.hide();
					});
				}


			}

			trigger.on('click' , function(){
				init('expand');
			});

			overlay.on('click' , function(){
				init('close');
			});

			maincat_trigger.on('click' , function(){
				var type = $(this).attr('data-type');
				var target = $(this).siblings('.subcat');
				if(type == 'expandchild') {
					expandInit('expand' , target);
				}
			});

			backslide_trigger.on('click' , function(){

				expandInit('back');
			});

		});



	}

	$.fn.topbarfixing = function() {

		var topbarstate = 0;
		var topbarelement = $(this);
		var catmenu = $('#top_category_selection');
		var triggerpos = 50;


		$(window).on('scroll' , $.throttle (100 , function(){

				scrollPos = $(document).scrollTop();

				if(scrollPos > triggerpos && topbarstate == 0){
					topbarelement.add(catmenu).addClass('fixed' , function(){
						topbarstate = 1;
					});

				}
				else{
					topbarelement.add(catmenu).removeClass('fixed' , function(){
						topbarstate = 0;
					});


				}
			})
		);

	}


	$.fn.tooltip = function() {
		this.each(function(){
			$(this).hover(function(){
			        // Hover over code
			        var title = $(this).attr('data-tooltip');
			        $('<div class="tooltip"></div>').html(title).appendTo('body').fadeIn();
			}, function() {
			        // Hover out code
			        $('.tooltip').remove();
			}).mousemove(function(e) {
			        var mousex = e.pageX + 15; //Get X coordinates
			        var mousey = e.pageY - 20; //Get Y coordinates
			        $('.tooltip')
			        .css({ top: mousey, left: mousex })
			});
		});
	}



})(jQuery);


$(function(){ $('#top_search_input').searchCatSelector(); });

// search top
function search(){
  var category = $('.cat_list').val();
  var keyword  = $('#searchinput-text').val();
  window.location.href = category + '?q=' + keyword;
}

// Klik enter than search
$(document).ready(function() {
    $('#searchinput-text').keydown(function(e) {
		    if (e.which === 13) {
					  search();
		    return false;
		    }
   });
});


// photo upload
$(document).ready(function(){
	$('.photocontainer').on('click' , function(){
		var target = $(this).attr('rel');
		$('.fileinput #'+target).click();
	});
});

//initiate tooltip

$(document).ready(function(){
	$('.tooltip-trigger').tooltip();
});

$(document).ready(function(){
	$('.photocontainer').on('click' , function(){
		var target = $(this).attr('rel');
		$('.fileinput #'+target).click();
	});
});
