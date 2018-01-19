$(document).ready(function () {
  $(document).on('submit', '.myForm', function (e) {
        $sub_button = 'button[type=submit]';
        e.preventDefault();
        if (!formValidate($(this))) {
            return false;
        }

        $($sub_button).addClass('loadingi');
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
            $($sub_button).removeClass('loadingi');
        }).fail(function (data) {
            toastr.error(data.message);
            $($sub_button).removeClass('loadingi');
        });
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
