jQuery(document).ready(function() {


    $('.like-product').click(function() {
        $(this).toggleClass('fa-heart');
        $(this).toggleClass('fa-heart-o');
    });


    $(".incr-btn").on("click", function(e) {
        var $button = $(this);
        var oldValue = $button.parent().find('.quantity').val();
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();
    });

    $('#slider').owlCarousel({

        autoplay: true,
        rtl: true,
        loop: true,
        nav: false,
        dots: true,
        transitionStyle: true,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        navText: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    $('#product').owlCarousel({
        autoplay: true,
        rtl: true,
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        transitionStyle: true,
        autoplayTimeout: 10000,
        navText: [
            "<i class='fa fa-angle-right'></i>",
            "<i class='fa fa-angle-left'></i>"
        ],
        thumbs: true,
        thumbsPrerendered: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });


    $('#feature').owlCarousel({
        autoplay: true,
        rtl: true,
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        transitionStyle: true,
        autoplayTimeout: 10000,
        navText: [
            "<i class='fa fa-arrow-right'></i>",
            "<i class='fa fa-arrow-left'></i>"
        ],

        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    $('#pages').owlCarousel({
        autoplay: true,
        rtl: true,
        margin: 20,
        loop: true,
        nav: true,
        dots: false,
        transitionStyle: true,
        autoplayTimeout: 10000,
        navText: [
            "<i class='fa fa-angle-right'></i>",
            "<i class='fa fa-angle-left'></i>"
        ],

        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    $('.smallimage').click(function() {
        var src = $(this).attr('src');
        $('.upper').html('<img src="' + src + '" />');
    });


    $('#stars li').on('mouseover', function() {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function() {
        $(this).parent().children('li.star').each(function(e) {
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function() {
        onStar = parseInt($(this).data('value'), 10); // The star currently selected
        stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

    });


});



function formatState(state) {
    if (!state.id) {
        return state.text;
    }
    var $state = $(
        '<span><img src="' + $(state.element).attr('data-src') + '" class="img-flag" /> ' + state.text + '</span>'
    );
    return $state;
};
$('.myselect').select2({
    minimumResultsForSearch: Infinity,
    templateResult: formatState,
    templateSelection: formatState
});

$(".choosings").select2({

});
$(' .owl_1').owlCarousel({
    loop:true,
    margin:10,
      rtl: true,
      nav:false,
      dots:false,
	autoplay:true,
	 slideSpeed: 400,
      paginationSpeed: 400,
	 autoplayTimeout:3000,
    responsive:{
        0:{
            items:3,
            margin:0
        
        },
        600:{
            items:4
         
        },
        1000:{
            items:4
          
        }
    }
});

$(document) .ready(function(){
var li =  $(".owl-item li ");
$(".owl-item li").click(function(){
li.removeClass('active');
});
});