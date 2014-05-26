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
    if confirm('您決定投給 ' + $('#selection').val() + ' 號 ' + $('.candidate.selection.selected').children('.name').html() + '，確定嗎？ You have decided to vote for no.' + $('#selection').val() + ' - ' + $('.candidate.selection.selected').children('.name').html() + ', is that right?')
      $('input[type="submit"]').prop 'disabled', true
      $(this).addClass 'submitted'
      return true
    else
      return false
  else
    if confirm('您決定投空白廢票，確定嗎？ You have decided to cast a blank ballot, is that right?')
      $('input[type="submit"]').prop 'disabled', true
      $(this).addClass 'submitted'
      return true
    else
      return false

$('.step3-form').submit ->
  if confirm('確定送出？ Are you sure you want to submit?')
    $('input[type="submit"]').prop 'disabled', true
    $(this).addClass 'submitted'
    return true
  else
    return false
