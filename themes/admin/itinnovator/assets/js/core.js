$(document).ready(function () {
  $(document).on('focus', '.mdl-input', function () {
    $(this).parent().addClass('is-focused');
  });

  $('#meta_keywords, #ADMIN_EMAIL').tagsinput();

  // $('[name=phone], [name=mobile]').mask('(000) 000-0000');
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
