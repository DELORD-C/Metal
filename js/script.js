window.onload = function () {
  $('.mobile').click(function () {
    $('nav').toggleClass('active')
  });

  $('nav ul li ul').each(function () {
    $(this).before('<span class="arrow"></span>')
  });

  $('nav ul li').click(function () {
    $(this).children('ul').toggleClass('active')
    $(this).children('.arrow').toggleClass('rotate')
  });
  $('.modal').modal('hide')


  $('#email').focusout(function () {
    var email = $("#email").val();
    if (email == "" || !email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#email').val('');
      $('#email').css("background-color", "red");
      $('#email').css("border-radius", "5px");
      $('#email').attr("placeholder", "Email invalide.");
    } else {
      $.ajax({
        url: 'php/checkData.php?email=' + email,
        type: 'post',
        data: email,
        success: function (data, status) {
          if (data == 0) {
            $("#submit").hide();
            $("#submit").attr("onClick", "return false");
            $('#email').val('');
            $('#email').css("background-color", "red");
            $('#email').css("border-radius", "5px");
            $('#email').attr("placeholder", "Email déjà existant !");
          }
          if (data == 1) {
            $('#email').css("background-color", "");
            $('#email').css("border-radius", "");
            $('#email').attr("placeholder", "ex : xXb_moulinXx@gmail.com");
            $("#submit").show();
            $("#submit").attr("onClick", "return true");
          }
        },
      });
    }
  });

  $('#nick').focusout(function () {
    var nick = $("#nick").val();
    if (nick == "" || !nick.match(/^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#nick').val('');
      $('#nick').css("background-color", "red");
      $('#nick').css("border-radius", "5px");
      $('#nick').attr("placeholder", "6 à 18 caractères alphanumériques.");
    } else {
      $.ajax({
        url: 'php/checkData.php?nick=' + nick,
        type: 'post',
        data: nick,
        success: function (data, status) {
          if (data == 0) {
            $("#submit").hide();
            $("#submit").attr("onClick", "return false");
            $('#nick').val('');
            $('#nick').css("background-color", "red");
            $('#nick').css("border-radius", "5px");
            $('#nick').attr("placeholder", "Nom d'utilisateur déjà existant !");
          }
          if (data == 1) {
            nick = nick.charAt(0).toUpperCase() + nick.slice(1);
            $('#nick').val(nick);
            $('#nick').css("background-color", "");
            $('#nick').css("border-radius", "");
            $('#nick').attr("placeholder", "ex : Tracteurstyx");
            $("#submit").show();
            $("#submit").attr("onClick", "return true");
          }
        },
      });
    }
  });

  $('#firstname').focusout(function () {
    var name = $('#firstname').val();
    if (name == "" || !name.match(/^[A-z]{1}[A-z]+$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#firstname').val('');
      $('#firstname').css("background-color", "red");
      $('#firstname').css("border-radius", "5px");
      $('#firstname').attr("placeholder", "Deux lettres ou plus.");
    } else {
      name = name.toUpperCase();
      $('#firstname').val(name);
      $('#firstname').css("background-color", "");
      $('#firstname').css("border-radius", "");
      $('#firstname').attr("placeholder", "ex : MOULIN");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#lastname').focusout(function () {
    var name = $('#lastname').val();
    if (name == "" || !name.match(/^([A-z]|[áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸ]){1}([A-z]|[áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸ])+$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#lastname').val('');
      $('#lastname').css("background-color", "red");
      $('#lastname').css("border-radius", "5px");
      $('#lastname').attr("placeholder", "Deux caractères ou plus.");
    } else {
      name = name.charAt(0).toUpperCase() + name.slice(1);
      $('#lastname').val(name);
      $('#lastname').css("background-color", "");
      $('#lastname').css("border-radius", "");
      $('#lastname').attr("placeholder", "ex : Billie");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#town').focusout(function () {
    var town = $('#town').val();
    if (town == "" || !town.match(/^[A-z]{1}[A-z]+$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#town').val('');
      $('#town').css("background-color", "red");
      $('#town').css("border-radius", "5px");
      $('#town').attr("placeholder", "Deux lettres ou plus.");
    } else {
      town = town.toUpperCase();
      $('#town').val(town);
      $('#town').css("background-color", "");
      $('#town').css("border-radius", "");
      $('#town').attr("placeholder", "ex : LYON");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#emailconfirm').focusout(function () {
    var emailconfirm = $('#emailconfirm').val();
    if (emailconfirm == "" || emailconfirm != $('#email').val()) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#emailconfirm').val('');
      $('#emailconfirm').css("background-color", "red");
      $('#emailconfirm').css("border-radius", "5px");
      $('#emailconfirm').attr("placeholder", "L'email ne correspond pas.");
    } else {
      $('#emailconfirm').css("background-color", "");
      $('#emailconfirm').css("border-radius", "");
      $('#emailconfirm').attr("placeholder", "Confirmation");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#password').focusout(function () {
    var password = $('#password').val();
    if (password == "" || !password.match(/^(.{5})(.+)$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#password').val('');
      $('#password').css("background-color", "red");
      $('#password').css("border-radius", "5px");
      $('#password').attr("placeholder", "Deux lettres ou plus.");
    } else {
      $('#password').css("background-color", "");
      $('#password').css("border-radius", "");
      $('#password').attr("placeholder", "**********");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#passwordconfirm').focusout(function () {
    var passwordconfirm = $('#passwordconfirm').val();
    if (passwordconfirm == "" || passwordconfirm != $('#password').val()) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#passwordconfirm').val('');
      $('#passwordconfirm').css("background-color", "red");
      $('#passwordconfirm').css("border-radius", "5px");
      $('#passwordconfirm').attr("placeholder", "Le mot de passe ne correspond pas.");
    } else {
      $('#passwordconfirm').css("background-color", "");
      $('#passwordconfirm').css("border-radius", "");
      $('#passwordconfirm').attr("placeholder", "Confirmation");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#zemail').focusin(function () {
    this.removeAttribute('readonly');
  });

  $('#password').focusin(function () {
    this.removeAttribute('readonly');
  });

  $('#passwordconfirm').focusin(function () {
    this.removeAttribute('readonly');
  });

  $('#zpassword').focusin(function () {
    this.removeAttribute('readonly');
  });

  $('#zpasswordconfirm').focusin(function () {
    this.removeAttribute('readonly');
  });

  $('#zemail').focusout(function () {
    var email = $("#zemail").val();
    if (email == "" || !email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#zemail').val('');
      $('#zemail').css("background-color", "red");
      $('#zemail').css("border-radius", "5px");
      $('#zemail').attr("placeholder", "Email invalide.");
    } else {
      $.ajax({
        url: 'php/checkData.php?zemail=' + email,
        type: 'post',
        data: email,
        success: function (data, status) {
          if (data == 0) {
            $("#submit").hide();
            $("#submit").attr("onClick", "return false");
            $('#zemail').val('');
            $('#zemail').css("background-color", "red");
            $('#zemail').css("border-radius", "5px");
            $('#zemail').attr("placeholder", "Email déjà existant !");
          }
          if (data == 1) {
            $('#zemail').css("background-color", "");
            $('#zemail').css("border-radius", "");
            $('#zemail').attr("placeholder", "ex : xXb_moulinXx@gmail.com");
            $("#submit").show();
            $("#submit").attr("onClick", "return true");
          }
        },
      });
    }
  });

  $('#znick').focusout(function () {
    var nick = $("#znick").val();
    if (nick == "" || !nick.match(/^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/)) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#znick').val('');
      $('#znick').css("background-color", "red");
      $('#znick').css("border-radius", "5px");
      $('#znick').attr("placeholder", "6 à 18 caractères alphanumériques.");
    } else {
      $.ajax({
        url: 'php/checkData.php?znick=' + nick,
        type: 'post',
        data: nick,
        success: function (data, status) {
          if (data == 0) {
            $("#submit").hide();
            $("#submit").attr("onClick", "return false");
            $('#znick').val('');
            $('#znick').css("background-color", "red");
            $('#znick').css("border-radius", "5px");
            $('#znick').attr("placeholder", "Nom d'utilisateur déjà existant !");
          }
          if (data == 1) {
            nick = nick.charAt(0).toUpperCase() + nick.slice(1);
            $('#znick').val(nick);
            $('#znick').css("background-color", "");
            $('#znick').css("border-radius", "");
            $('#znick').attr("placeholder", "ex : Tracteurstyx");
            $("#submit").attr("onClick", "return true");
            $("#submit").show();
            $("#submit").attr("onClick", "return true");
          }
        },
      });
    }
  });

  $('#zpassword').focusout(function () {
    var password = $('#zpassword').val();
    if (password.length != 0 && !password.match(/^(.{5})(.+)$/)) {
      console.log(password.length);
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#zpassword').val('');
      $('#zpassword').css("background-color", "red");
      $('#zpassword').css("border-radius", "5px");
      $('#zpassword').attr("placeholder", "Deux lettres ou plus.");
    } else {
      $('#zpassword').css("background-color", "");
      $('#zpassword').css("border-radius", "");
      $('#zpassword').attr("placeholder", "**********");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('#zpasswordconfirm').focusout(function () {
    var passwordconfirm = $('#zpasswordconfirm').val();
    if (passwordconfirm != $('#zpassword').val()) {
      $("#submit").hide();
      $("#submit").attr("onClick", "return false");
      $('#zpasswordconfirm').val('');
      $('#zpasswordconfirm').css("background-color", "red");
      $('#zpasswordconfirm').css("border-radius", "5px");
      $('#zpasswordconfirm').attr("placeholder", "Le mot de passe ne correspond pas.");
    } else {
      $('#zpasswordconfirm').css("background-color", "");
      $('#zpasswordconfirm').css("border-radius", "");
      $('#zpasswordconfirm').attr("placeholder", "Confirmation");
      $("#submit").show();
      $("#submit").attr("onClick", "return true");
    }
  });

  $('.filters-button').click(function () {
    console.log($('.filters').css("display"));
    if ($('.filters').css("display") === 'none') {
      $('.filters').fadeIn();
    } else if ($('.filters').css("display") === 'block') {
      $('.filters').fadeOut();
    }
  });

  $('.frange').mousedown(function () {
    $('.frange').mousemove(function () {
      $('.frange-text').html($('.frange').val());
      $('.srange').attr("min", $('.frange').val());
    })
  });

  $('.srange').mousedown(function () {
    $('.srange').mousemove(function () {
      $('.srange-text').html($('.srange').val());
      $('.frange').attr("max", $('.srange').val());
    })
  });

  $('.btn-menu').click(function () {
    if ($('.unroll').css("display") === 'none') {
      $('.unroll').fadeIn();
    } else if ($('.unroll').css("display") === 'block') {
      $('.unroll').fadeOut();
    }
  });

  $(document).mouseup(function (e) {
    var container = $('.unroll')
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.fadeOut()
    }
  });

  $(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
      $('.unroll').fadeOut()
    }
  });

  $('.unroll').click(function () {
    $('.unroll').fadeOut();
  });



  $('.tab-element').click(function(){
    var i = 1;
    $('.tab-element').each(function(){
      if($(this).hasClass('active')) {
        switch (i) {
          case 1:
            $('.tab-bg').css("left", "8.2%");
            break;

          case 2:
            $('.tab-bg').css("left", "32.5%");
            break;

          case 3:
            $('.tab-bg').css("left", "56.9%");
            break;

          case 4:
            $('.tab-bg').css("left", "81.5%");
            break;

          default:
            break;
        }

      }
      i++;
    });
  });

  var a = 1;
  $('.tab-element').each(function(){
    if($(this).hasClass('active')) {
      switch (a) {
        case 1:
          $('.tab-bg').css("left", "8.2%");
          break;

        case 2:
          $('.tab-bg').css("left", "32.5%");
          break;

        case 3:
          $('.tab-bg').css("left", "56.9%");
          break;

        case 4:
          $('.tab-bg').css("left", "81.5%");
          break;

        default:
          break;
      }

    }
    a++;
  });

  // background-color: #00000054;
  // border-radius: 5px 5px 0 0;
  // border: 2px solid #4e1c55;
  // border-bottom: 0;
  // box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.75);

  carousel = (function () {
    var box = document.querySelector('.carouselbox');
    var next = box.querySelector('.next');
    var prev = box.querySelector('.prev');
    var items = box.querySelectorAll('.content li');
    var counter = 0;
    var amount = items.length;
    var current = items[0];
    box.classList.add('active');

    function navigate(direction) {
      current.classList.remove('current');
      counter = counter + direction;
      if (direction === -1 &&
        counter < 0) {
        counter = amount - 1;
      }
      if (direction === 1 &&
        !items[counter]) {
        counter = 0;
      }
      current = items[counter];
      current.classList.add('current');
    }
    next.addEventListener('click', function (ev) {
      navigate(1);
    });
    prev.addEventListener('click', function (ev) {
      navigate(-1);
    });
    navigate(0);
  })();

};