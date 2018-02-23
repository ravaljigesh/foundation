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
