$.fn.modal = function (param1) {
  if (param1 === 'show') {
    this.show()
  } else if (param1 === 'hide') {
    this.hide()
  }
  $('.popin-dismiss').click(function () {
    $('#myModal').fadeOut()
  })
  $('.modalShow').click(function () {
    var target = '#' + this.getAttribute('data-target')
    $(target).fadeIn()
  })
  $(document).mouseup(function (e) {
    var container = $('.modal')
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.fadeOut()
    }
  })
  $(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
      $('.modal').fadeOut()
    }
  })
  $('.tab-element').click(function () {
    $('.tab-element').each(function () {
      this.classList.remove('active')
      var hidden = '.' + this.getAttribute('data-target')
      $(hidden).hide()
    })
    this.classList.add('active')
    var target = '.' + this.getAttribute('data-target')
    $(target).show()
  })

  $('.tab-element').each(function () {
    this.classList.forEach(classes => {
      if (classes === 'active') {
        var targetshow = '.' + this.getAttribute('data-target')
        $(targetshow).show()
      }
    });
  });

  function TabListColumns() {
    if (typeof ($('.tab-list')[0]) != 'undefined') {
      var nbr = ($('.tab-list')[0].getElementsByTagName('li')).length
      var cssinput = ''
      for (var i = 0; i < nbr; i++) {
        cssinput += '1fr '
      }
      $('.tab-list')[0].style.gridTemplateColumns = cssinput
    }
  }

  function ContainerColumns(objet) {
    var nbr = ((objet.childNodes[1].childNodes.length - 1) / 2)
    var cssinput = ''
    for (var i = 0; i < nbr; i++) {
      cssinput += '1fr '
    }
    objet.childNodes[1].style.gridTemplateColumns = cssinput
  }

  function themeTooltip(target) {
    switch (target.getAttribute('data-theme')) {
      case 'dark':
        $(target).next().css('background-color', '#303030')
        $(target).next().css('color', 'white')
        $(target).next().css('border', 'solid 1px white')
        break

      case 'light':
        $(target).next().css('background-color', '#dddddd')
        $(target).next().css('color', 'black')
        break

      default:
        break
    }
  }

  $('.tooltip').each(function () {
    if (this.getAttribute('title') !== null) {
      if (this.getAttribute('tooltip-create') !== 'true') {
        var title = this.getAttribute('title')
        $(this).after("<span class='display-tooltip'>" + title + '</span>')
        this.setAttribute('tooltip-create', 'true')
        this.removeAttribute('ufdata')
        this.removeAttribute('title')
      }
    }
  })

  $('.tooltip').mouseenter(function () {
    if (this.getAttribute('data-placement') !== null) {
      var pos = this.getAttribute('data-placement')
      console.log(this.getAttribute('data-placement'))
    } else {
      pos = 'top'
    }
    var width = $(this).outerWidth()
    var height = $(this).outerHeight()
    var thisheight = $(this).next().outerHeight()
    var thiswidth = $(this).next().outerWidth()
    var position = $(this).position()
    switch (pos) {
      case 'top':
        $(this).next().css('top', (position.top - thisheight - 5) + 'px')
        $(this).next().css('left', (position.left + ((width - thiswidth) / 2)) + 'px')
        break

      case 'bottom':
        $(this).next().css('top', (position.top + height + 5) + 'px')
        $(this).next().css('left', (position.left + ((width - thiswidth) / 2)) + 'px')

        break

      case 'left':
        $(this).next().css('top', (position.top + ((height - thisheight) / 2)) + 'px')
        $(this).next().css('left', (position.left - thiswidth - 5) + 'px')
        break

      case 'right':
        $(this).next().css('top', (position.top + ((height - thisheight) / 2)) + 'px')
        $(this).next().css('left', (position.left + width + 5) + 'px')
        break

      default:
        break
    }
    themeTooltip(this)
    $(this).next().hide().fadeIn()
  })

  $('.tooltip').mouseleave(function () {
    $(this).next().fadeOut()
  })

  TabListColumns()

  $('.container').each(function () {
    ContainerColumns(this)
  })

  $('.container-fluid').each(function () {
    ContainerColumns(this)
  })
}