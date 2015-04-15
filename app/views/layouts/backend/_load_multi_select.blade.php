{{HTML::style('backend/multi_select/multi-select.css')}}
{{HTML::script('backend/multi_select/jquery.multi-select.js')}}
<script type="text/javascript">
	// var selected_array = $('.multi-select-values').val().split(",");
 //    $('.multi-select').multiSelect({
 //        afterSelect: function (values) {
 //            selected_array.push(values);
 //            //alert(selected_array);
 //            $('.multi-select-values').val(selected_array);
 //        },
 //        afterDeselect: function (values) {
 //            selected_array.splice($.inArray(values, selected_array), 1);
 //            //alert(selected_array);
 //            $('.multi-select-values').val(selected_array);
 //        }
 //    });
	$('.multi-select').multiSelect();
</script>