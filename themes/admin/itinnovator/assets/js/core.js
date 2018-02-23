<<<<<<< HEAD
$(document).ready(function() {
  $(document).on('click', '._ac', function(e) {
    e.preventDefault();
    // var belt_div = $('.new-column > div').last();
    // var i = 0;
    // if (belt_div.length > 0) {
    //   i = belt_div.attr('data-count');
    //   i++;
    // }
    // var html = '';
    // html += '<div class="para pr' + i + '" data-count=' + i + '>';
    // html += '<div class="wrap-bw">';
    // html += '<div class="two fields">';
    // html += '<div class="field mdl-field">';
    // html += '<label class="mdl-label" for="component_name">component Name</label>';
    // html += '<input class="mdl-input input-sm " name="component[' + i + '][field_name]" type="text" id="component_name[' + i + ']" value="">';
    // html += '</div>';
    // html += '<div class="select-parent form-group is-focused myForm-group"><label class="myLabel without-margin-top" for="column_type">Column Type</label><select class="form-control  " name="component[' + i + '][column_type]" id="column_type[' + i + ']"><option value="string">Varchar</option><option value="integer">Integer</option><option value="incremental">Auto Incremental</option><option value="bigInteger">Big Integer</option><option value="text">Text</option><option value="longText">Long Text</option><option value="datetime">Date Time</option><option value="date">Date</option><option value="time">time</option><option value="decimal">Decimal</option></select></div>';
    // html += '<div class="select-parent form-group is-focused myForm-group"><label class="myLabel without-margin-top" for="required">Required </label><select class="form-control " name="component[' + i + '][required]" id="required[' + i + ']"><option value="1">Yes</option><option selected="" value="0">No</option></select></div>';
    // html += '<div class="field mdl-field">';
    // html += '<label class="mdl-label" for="parameter_value">Default</label>';
    // html += '<input class="mdl-input input-sm" name="component[' + i + '][default]" type="text" id="parameter_name[' + i + ']" value="">';
    // html += '</div>';
    // html += '</div>';
    // html += '</div></div></div>';
    //
    // $('#component-create').removeClass('none');
    // $('.new-column').append(html);

    $('._mc').first().clone().insertBefore('.new-column');
  });
});
=======
$(document).ready(function () {
  $(document).on('focus', '.mdl-input', function () {
    $(this).parent().addClass('is-focused');
  });

  $('#meta_keywords, #ADMIN_EMAIL').tagsinput();
  $('[name=phone], [name=mobile]').inputmask('(999) 999-9999');

  $('.mdl-input').each(function () {
    if ($(this).val().length > 0) {
      $(this).parent().addClass('is-focused');
    }
  });

  $(document).on('blur', '.mdl-input', function () {
    val = $(this).val();
    if (val.length > 0) {
      $(this).parent().addClass('is-focused');
    } else {
      $(this).parent().removeClass('is-focused');
    }
  });

  $(document).on('click', '.javascript', function (e) {
      e.preventDefault();
      toggle = $(this).attr('toggle');
      hide = $(this).attr('hide');
      show = $(this).attr('show');
      scroll = $(this).attr('scroll');
      url = $(this).attr('location');
      remove = $(this).attr('remove');
      content = $(this).attr('content');
      con = $(this).attr('confirm_msg');
      method = $(this).attr('method');

      if (remove) {
        $(remove).remove();
      }

      if (hide) {
      }
      $(hide).slideUp('fast');

      if (toggle) {
        $(toggle).slideToggle('fast');
      }

      if (show) {
        $(show).slideDown('fast');
      }

      if (scroll) {
        var animate_scroll = $('html, body').stop(!0,!1).animate({
          scrollTop:$(scroll).offset().top - 50},
          500);
          clearTimeout(animate_scroll);
        }

        if (url) {
          // NProgress.configure({ showSpinner: true });
          // NProgress.start();
          if (con) {
            if (confirm(con)) {
              confirm(con);
            } else {
              // NProgress.done();
              return true;
            }
          }
          div_to_update = $(this).attr('div_to_update');
          if (div_to_update) {
            element = div_to_update;
          } else {
            element = $(this).attr('id');
          }
          if (method && method == 'post') {
            data = $(this).attr('data');
            arr = data.split(',');
            post = {};
            post['_token'] = CSRF;
            post['element'] = $(this).attr('id');
            $.each(arr, function (index, value) {
              post[value] = $('#' + value).val();
            });
            $(this).addClass('m-loader');
            $.post(url, post, '', 'json').always(function (data) {
              if (data.status == 'html') {
                ele = data.field;
                element = $('#' + ele);
                div_to_update = element.attr('div_to_update');
                if (div_to_update) {
                  $('#' + div_to_update).html(data.message);
                } else {
                  element.html(data.message);
                }
              }

              if (data.status == 'success') {
                toastr.success(data.message);
                el = $('#' + data.field);
                el.removeClass('m-loader');
                cb = el.attr('callback');
                if (cb) {
                  window[cb]();
                }
              }

              if (data.status == 'error') {
                el = $('#' + data.field);
                el.removeClass('m-loader');
                toastr.error(data.message);
              }

              if (data.status == 'redirect') {
                redirect(data.message);
              }

              // NProgress.done();
            });
          } else {
            $.get(url, {element: element}, '', 'json').always(function (data) {
              if (data.status == 'html') {
                ele = data.field;
                element = $('#' + ele);
                div_to_update = element.attr('div_to_update');
                if (div_to_update) {
                  $('#' + div_to_update).html(data.message);
                } else {
                  element.html(data.message);
                }
              }

              if (data.status == 'success') {
                toastr.success(data.message);
              }

              if (data.status == 'error') {
                toastr.error(data.message);
              }

              if (data.status == 'redirect') {
                redirect(data.message);
              }

              // NProgress.done();
            });
          }
        }
    });
});


$(document).on('submit', '.myForm', function (e) {
    $sub_button = 'button[type=submit]';
    e.preventDefault();
    if (!formValidate($(this))) {
        return false;
    }

    $($sub_button).addClass('m-loader');
    url = window.location;

    if ($(this).attr('action')) {
      url = $(this).attr('action');
    }

    $.post(url, $(this).serialize(), '', 'json').always(function (data) {
        if (data.status == 'success') {
              location.reload();
              toastr.success(data.message);
            // $('body').load(window.location + ' .big-container', function () {
            // });
        }

        if (data.status == 'redirect') {
            toastr.success('Success!');
            window.location = data.message;
            // redirect(data.message);
        }

        if (data.status == 'back') {
            window.location = document.referrer;
        }

        if (data.status == 'refresh') {
            // location.reload();
        }

        if (data.status == 'error') {
            toastr.error(data.message);
        }
        $($sub_button).removeClass('m-loader');
    }).fail(function (data) {
        toastr.error(data.message);
        $($sub_button).removeClass('m-loader');
    });
});
function formValidate(form)
{
      rf = form.find('#required').val();

      if (!rf) {
        return true;
      }
      rf = rf.split(',');

      errors = false;
      $.each(rf, function(i) {
         input = '#' + rf[i];
         input_bar = form.find(input);
         if (!input_bar) {
             return;
         }
         myVal = input_bar.val();
         if (!myVal) {
            console.log(input);
             label = $(input_bar).parent().find('label');
             $(input_bar).parent().addClass('invalid');
             if (label.text() != '') {
                 toastr.error(label.text() + ' is required');
             }
             errors = true;
         }
      });
      if (errors) {
          return false;
      }

      return true;
  }
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
