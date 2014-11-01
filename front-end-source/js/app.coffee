$v = $('.main > *')

if $v.width()*$v.length < $(window).width()
  $('.main').addClass('mini')
else
  $('.main').prepend('<span class="main-before"></span>')
  $('.main').append('<span class="main-after"></span>')

$('.candidate .choices').append('<span class="choices-visualizer"><span class="agree"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="600px" height="600px" viewBox="0 0 600 600" xml:space="preserve"><circle class="background" cx="300" cy="300" r="360"/><path class="icon" d="M300,125c46.744,0,90.691,18.203,123.744,51.256S475,253.256,475,300 s-18.203,90.691-51.256,123.744S346.744,475,300,475s-90.691-18.203-123.744-51.256S125,346.744,125,300 s18.203-90.691,51.256-123.744S253.256,125,300,125 M300,75C175.736,75,75,175.736,75,300s100.736,225,225,225s225-100.736,225-225 S424.264,75,300,75L300,75z"/></svg></span><span class="none"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="600px" height="600px" viewBox="0 0 600 600" xml:space="preserve"><circle class="background" cx="300" cy="300" r="360"/><rect class="icon" x="125" y="275" width="350" height="50"/></svg></span><span class="disagree"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="600px" height="600px" viewBox="0 0 600 600" xml:space="preserve"><circle class="background" cx="300" cy="300" r="360"/><polygon class="icon" points="476.776,158.579 441.421,123.224 300,264.645 158.579,123.224 123.224,158.579 264.645,300 123.224,441.421 158.579,476.776 300,335.355 441.421,476.776 476.776,441.421 335.355,300"/></svg></span></span>')

setTimeout ->
  $('.input').removeClass 'shake'
, 1000

if $('#password3').val()?.length > 0 || $('#password2').val()?.length > 0 || $('#password1').val()?.length > 0
  $('#password1').val ''
  $('#password2').val ''
  $('#password3').val ''

$('#password1').keyup ->
  $(this).val $(this).val().toUpperCase()
  if $(this).val().length >= $(this).attr('maxlength')
    $('#password2').focus()
    setTimeout ->
      $('#password2').focus()
    , 1000

$('#password2').keyup ->
  $(this).val $(this).val().toUpperCase()
  if $(this).val().length >= $(this).attr('maxlength')
    $('#password3').focus()

$('#password3').keyup ->
  $(this).val $(this).val().toUpperCase()

$('#password1').keydown ->
  $('.input').removeClass 'error'

$('#password2').keydown (e) ->
  $('.input').removeClass 'error'
  if $(this).val().length == 0 && (e.keyCode == 8 || e.keyCode == 37)
    $('#password1').focus()

$('#password3').keydown (e) ->
  $('.input').removeClass 'error'
  if $(this).val().length == 0 && (e.keyCode == 8 || e.keyCode == 37)
    $('#password2').focus()

$('.candidate.selection').each ->
  $(this).click ->
    if $(this).hasClass 'selected'
      $('.candidate.selection').removeClass 'selected'
      $('#selection').val ''
    else
      $('#selection').val $(this).children('.id').html()
      $('.candidate.selection').removeClass 'selected'
      $(this).addClass 'selected'

$('.step1-form').submit ->
  if $('#password1').val().match('[A-Z][0-9][A-Z]{2}') && $('#password2').val().match('[A-Z]{3}') && $('#password3').val().match('[A-Z]{3}')
    return true
  else
    $('.input').addClass 'error animated shake'
    setTimeout ->
      $('.input').removeClass 'shake'
    , 1000
    $('#password3').focus()
    return false

$('.step2-form').submit ->
  if $('.candidate.selection.selected')[0]
    if confirm('您決定投給 ' + $('#selection').val() + ' 號 ' + $('.candidate.selection.selected').children('.name').html() + '，確定嗎？\n You’ve decided to vote for No. ' + $('#selection').val() + ' - ' + $('.candidate.selection.selected').children('.name').html() + ', is that right?')
      $('input[type="submit"]').prop 'disabled', true
      $(this).addClass 'submitted'
      return true
    else
      return false
  else
    if confirm('您決定投空白廢票，確定嗎？\n You’ve decided to cast a blank ballot, is that right?')
      $('input[type="submit"]').prop 'disabled', true
      $(this).addClass 'submitted'
      return true
    else
      return false

$('.step3-form').submit ->
  if confirm('確定送出？\n Are you sure you want to submit?')
    $('input[type="submit"]').prop 'disabled', true
    $(this).addClass 'submitted'
    return true
  else
    return false

setTimeout ->
  $('body').addClass('ready')
, 300
