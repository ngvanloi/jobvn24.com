// JavaScript Document
$(document).ready(function () {
  function randomString(length) {
    let result = "";
    let characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    let charactersLength = characters.length;
    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
  }

  function randomNumber(length) {
    let result = "";
    let numbers = "0123456789";
    let numbersLength = numbers.length;
    for (let i = 0; i < length; i++) {
      result += numbers.charAt(Math.floor(Math.random() * numbersLength));
    }
    return result;
  }

  let randomNick = randomString(4) + randomNumber(4);
  //메인비주얼 팝업
  var swiper1 = new Swiper(".main_visual .swiper-container", {
    loop: true, //무한반복(순환)
    autoplay: { delay: 11000, disableOnInteraction: false },
    pagination: {
      el: ".main_visual_paging .swiper-pagination",
      clickable: true,
      type: "bullets",
    },
  });

  //메인탭메뉴
  $(function () {
    $(".tabcontent > div").hide();
    $(".tabnav a")
      .click(function () {
        $(".tabcontent > div").hide().filter(this.hash).fadeIn();
        $(".tabnav a").removeClass("active");
        $(this).addClass("active");
        return false;
      })
      .filter(":eq(0)")
      .click();
  });

  //메인탭공지사항
  var swiper2 = new Swiper(".notice_box>.swiper-container", {
    loop: true,
    autoplay: { delay: 11000, disableOnInteraction: false },
    speed: 500,
    direction: "vertical",
    navigation: {
      prevEl: ".notice_box .btn_prev", //이전페이지 버튼
      nextEl: ".notice_box .btn_next", //이후 페이지 버튼
    },
  });

  //스크롤 top
  $(".h_top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      400
    );
    return false;
  });
  $("input[name='mb_nick'].mb_nick_individual").val(randomNick);
  //top메뉴 따라다니게
  /*
		  var menu_pos = '';
		  window.onscroll = function() {myFunction()};
  
		  var header = document.getElementById("head_top");
		  var sticky = header.offsetTop;
  
		  function myFunction() {
			  var body_height = document.getElementsByTagName("body")[0].offsetHeight;
			  menu_pos = window.scrollY;
			  if (window.pageYOffset > sticky) {
				  header.classList.add("fixed_header");
			  } else {
				  header.classList.remove("fixed_header");
			  }
		  }
  
  //
  */
});
