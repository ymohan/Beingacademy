//main_navigation
$('.menu').on('click', function () {
  $('.list').toggleClass('active');
});
//
function myFunction(x) {
  x.classList.toggle("change");
}
//scroll-to-top//
var btn = $('.top');
$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
    btn.addClass('visible');
  } else {
    btn.removeClass('show');
    btn.removeClass('visible');
  }
});
$("a[href='#top']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});
//scroll__reveal
window.addEventListener('scroll', revealOnScroll);

function revealOnScroll() {
  const elements = document.querySelectorAll('.reveal');
  let delay = 0;

  elements.forEach((element) => {
    const elementTop = element.getBoundingClientRect().top;
    const elementBottom = element.getBoundingClientRect().bottom;
    const threshold = 0.5;

    if (elementTop < window.innerHeight * threshold && elementBottom >= 0) {
      setTimeout(() => {
        element.classList.add('revealed');
      }, delay);
      delay += 15; // adjust delay time as desired
    }
  });
}
//modal__trigger
var _targettedModal,
    _triggers = document.querySelectorAll('[data-modal-trigger]'),
    _dismiss = document.querySelectorAll('[data-modal-dismiss]'),
    modalActiveClass = "is-modal-active";

function showModal(el){
    _targettedModal = document.querySelector('[data-modal-name="'+ el + '"]');
    _targettedModal.classList.add(modalActiveClass);
}

function hideModal(event){
    if(event === undefined || event.target.hasAttribute('data-modal-dismiss')) {
        _targettedModal.classList.remove(modalActiveClass);
    }
}

function bindEvents(el, callback){
    for (i = 0; i < el.length; i++) {
        (function(i) {
            el[i].addEventListener('click', function(event) {
                callback(this, event);
            });
        })(i);
    }   
}

function triggerModal(){
    bindEvents(_triggers, function(that){
        showModal(that.dataset.modalTrigger);
    });
}

function dismissModal(){
    bindEvents(_dismiss, function(that){
        hideModal(event);
    });
}

function initModal(){
    triggerModal();
    dismissModal();
}

initModal();
//randomize images
$('.masonry__container').append($('.masonry__container .container__item').detach().sort(_=>Math.random()>.29?1:-1));
//form__reset
$(document).ready(function() {
  $.ajax({
    type: "POST",
    url: "/subscribe.php",
    data: $("#my-form").serialize(),
    success: function() {
      $("#my-form").trigger("reset");
    }
  });
});

