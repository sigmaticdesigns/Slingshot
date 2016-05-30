//slider

$(document).ready(function(){
  $('.promo__slider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    draggable: false,
    pauseOnFocus: false,
    pauseOnHover: false
  });
});

//data picker
$('#start-date').pickmeup();


//text symbols counter

$(document).ready(function(){
  var maxCount = 135;

  $(".fields-group__counter").html(maxCount);

  $("#short-desc").keyup(function() {
  var shortDesc = this.value.length;

    if (this.value.length > maxCount) {
      this.value = this.value.substr(0, maxCount);
    }
    var cnt = (maxCount - shortDesc);
    if(cnt <= 0){$(".fields-group__counter").html('0');}
    else {$(".fields-group__counter").html(cnt);}
  });
});

