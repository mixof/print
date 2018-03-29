/*
 * Image preview script
 * powered by jQuery (http://www.jquery.com)
 *
 * written by Alen Grakalic (http://cssglobe.com)
 *
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */

$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#slideshow_container').slick({
		autoplay: true,
		arrows: true,
		dots: true,
		fade: false,
		slide: 'div',
    autoplaySpeed: 3750,
    speed: 1000,
		cssEase: 'linear',
		easing: 'linear',
		swipeToSlide: true,
		useCss: false,
		adaptiveHeight: true,
		onBeforeChange: function(slick, currentIndex, targetIndex) {
			// Make sure dots don't keep focus after clicking on them
			slick.$dots.children('li').eq(currentIndex).children().blur()
		}
	});

    $("h4.title").dotdotdot({
        ellipsis	: '... ',
        height: 32
    });

    var $preview = $(".preview");
    if ($preview) {
        var img = new Image();
        img.onload = function() {
            var someImg = $preview;
            if (someImg.width() > someImg.height()){
                $preview.addClass("landscape");
            } else if (someImg.width() < someImg.height()){
                $preview.addClass("portrait");
            }
        };
        img.src = $preview.attr("src");
    }

	$(".thumbnail")
		.on('mouseover', function(e) {
			$('body').append("<div id='preview'><img src='" + this.rel + "' alt='Image preview'></div>");

			$("#preview").position({
				of:  e,
				my: "left+3",
				collision: "flip"
			});

			$("#preview").fadeIn("fast");
		})
		.on('mousemove', function(e) {
			$("#preview").position({
				of:  e,
				my: "left+3",
				collision: "flip"
			});
		})
		.on('mouseout', function(e) {
			$("#preview").remove();
		});

	//photos tab inline editing:
	if ($("#photos").length) {
		//turn to inline mode
		$.fn.editable.defaults.mode = 'inline';
		$('.editable-input').editable({
			ajaxOptions: {
				dataType: 'json',
				type: 'POST'
			},
			success: function(response, newValue) {
				if (response.status == 'error')
					return response.msg; //msg will be shown in editable form
			}
		});
		$(".photo-edit").click(function(e) {
			e.preventDefault();
			var id = $(this).data("ref");
			$("#" + id).click();
			return false;
		});

		$(".autovalidate").validate();
	}

	var url = window.location.href;

	var digitalVisible = url.indexOf(2) > -1 ? true : false;
	var photoVisible = true;

	setDigitalRotation($("#digitalArtHeader"));

	function setDigitalRotation(element) {
		if(!digitalVisible) {
			$(element).children('.left-arrow').css('rotate', 0);
			digitalVisible = true;
			$(element).siblings('ul').slideUp();
		} else {
			$(element).children('.left-arrow').css('rotate', 90);
			digitalVisible = false;
			$(element).siblings('ul').slideDown();
		}
	}

	function setPhotoRotation(element) {
		if(!photoVisible) {
			$(element).children('.down-arrow').css('rotate', 270);
			photoVisible = true;
			$(element).siblings('ul').slideUp();
		} else {
			$(element).children('.down-arrow').css('rotate', 0);
			photoVisible = false;
			$(element).siblings('ul').slideDown();
		}
	}

	$("#digitalArtHeader").on("click", function () {
		setDigitalRotation(this);
	});

	$("#photoHeader").on("click", function () {
		setPhotoRotation(this);
	});

});
