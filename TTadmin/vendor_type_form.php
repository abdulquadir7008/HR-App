<?php
include('includes/configset.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>AdminLTE | Data Tables</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include('includes/head.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php'); ?>
  
      <?php 
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from vendor_type WHERE id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
?>
      <?php if(isset($_REQUEST['cms'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 } ?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage Projects <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify Projects- ".$row_cms['vendorer_type_name'];
			  }
			  else
			  {
				echo "Add Projects";  
			  }
			 
 ?> </li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify Projects- ".$row_cms['vendorer_type_name'];
			  }
			  else
			  {
				echo "Add Projects";  
			  }
			 
 ?> 
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="box box-primary"> 
                
                <!-- /.box-header --> 
                <!-- form start -->
                
                <form action="vendor_type_manage.php" method="post" enctype="multipart/form-data" name="cont"  id="myform" onSubmit="return validate();">
                  <div class="box-body">
                  
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1"> Vendor Type</label>
                      <input type="text" name="vendorer_type_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['vendorer_type_name']; ?>">
                    </div>
                    
                    
                    
                    
                    
                    
                     
                     
                    
                    
                    
<!--
<label for="exampleFileUpload" class="button">Upload File</label>
<input type="file" id="exampleFileUpload" class="show-for-sr">
-->


                    
                  </div>
                  <!-- /.box-body -->
                  
                  <div class="box-footer">
                    <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
                    <button type="submit"  name="<?php echo $sub ?>" class="btn btn-primary"><?php echo $sub2 ?></button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content --> 
  </aside>
  <!-- /.right-side --> 
</div>
<!-- ./wrapper --> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> 
<!-- AdminLTE App --> 
<!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="js/AdminLTE/demo.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#tagsSpec').tagsInput({
		'unique': true,
		'minChars': 2,
		'maxChars': 20,
		'limit': 10
	});	
});
/* jQuery Tags Input Revisited Plugin
 *
 * Copyright (c) Krzysztof Rusnarczyk
 * Licensed under the MIT license */

(function($) {
	var delimiter = [];
	var inputSettings = [];
	var callbacks = [];

	$.fn.addTag = function(value, options) {
		options = jQuery.extend({
			focus: false,
			callback: true
		}, options);
		
		this.each(function() {
			var id = $(this).attr('id');

			var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
			if (tagslist[0] === '') tagslist = [];

			value = jQuery.trim(value);
			
			if ((inputSettings[id].unique && $(this).tagExist(value)) || !_validateTag(value, inputSettings[id], tagslist, delimiter[id])) {
				$('#' + id + '_tag').addClass('error');
				return false;
			}
			
			$('<span>', {class: 'tag'}).append(
				$('<span>', {class: 'tag-text'}).text(value),
				$('<button>', {class: 'tag-remove'}).click(function() {
					return $('#' + id).removeTag(encodeURI(value));
				})
			).insertBefore('#' + id + '_addTag');

			tagslist.push(value);

			$('#' + id + '_tag').val('');
			if (options.focus) {
				$('#' + id + '_tag').focus();
			} else {
				$('#' + id + '_tag').blur();
			}

			$.fn.tagsInput.updateTagsField(this, tagslist);

			if (options.callback && callbacks[id] && callbacks[id]['onAddTag']) {
				var f = callbacks[id]['onAddTag'];
				f.call(this, this, value);
			}
			
			if (callbacks[id] && callbacks[id]['onChange']) {
				var i = tagslist.length;
				var f = callbacks[id]['onChange'];
				f.call(this, this, value);
			}
		});

		return false;
	};

	$.fn.removeTag = function(value) {
		value = decodeURI(value);
		
		this.each(function() {
			var id = $(this).attr('id');

			var old = $(this).val().split(_getDelimiter(delimiter[id]));

			$('#' + id + '_tagsinput .tag').remove();
			
			var str = '';
			for (i = 0; i < old.length; ++i) {
				if (old[i] != value) {
					str = str + _getDelimiter(delimiter[id]) + old[i];
				}
			}

			$.fn.tagsInput.importTags(this, str);

			if (callbacks[id] && callbacks[id]['onRemoveTag']) {
				var f = callbacks[id]['onRemoveTag'];
				f.call(this, this, value);
			}
		});

		return false;
	};

	$.fn.tagExist = function(val) {
		var id = $(this).attr('id');
		var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
		return (jQuery.inArray(val, tagslist) >= 0);
	};

	$.fn.importTags = function(str) {
		var id = $(this).attr('id');
		$('#' + id + '_tagsinput .tag').remove();
		$.fn.tagsInput.importTags(this, str);
	};

	$.fn.tagsInput = function(options) {
		var settings = jQuery.extend({
			interactive: true,
			placeholder: 'ex: - SPA (Maximum 2 word try)',
			minChars: 0,
			maxChars: null,
			limit: null,
			validationPattern: null,
			width: 'auto',
			height: 'auto',
			autocomplete: null,
			hide: true,
			delimiter: ',',
			unique: true,
			removeWithBackspace: true
		}, options);

		var uniqueIdCounter = 0;

		this.each(function() {
			if (typeof $(this).data('tagsinput-init') !== 'undefined') return;

			$(this).data('tagsinput-init', true);

			if (settings.hide) $(this).hide();
			
			var id = $(this).attr('id');
			if (!id || _getDelimiter(delimiter[$(this).attr('id')])) {
				id = $(this).attr('id', 'tags' + new Date().getTime() + (++uniqueIdCounter)).attr('id');
			}

			var data = jQuery.extend({
				pid: id,
				real_input: '#' + id,
				holder: '#' + id + '_tagsinput',
				input_wrapper: '#' + id + '_addTag',
				fake_input: '#' + id + '_tag'
			}, settings);

			delimiter[id] = data.delimiter;
			inputSettings[id] = {
				minChars: settings.minChars,
				maxChars: settings.maxChars,
				limit: settings.limit,
				validationPattern: settings.validationPattern,
				unique: settings.unique
			};

			if (settings.onAddTag || settings.onRemoveTag || settings.onChange) {
				callbacks[id] = [];

				callbacks[id]['onAddTag'] = settings.onAddTag;
				callbacks[id]['onRemoveTag'] = settings.onRemoveTag;
				callbacks[id]['onChange'] = settings.onChange;
			}

			var markup = $('<div>', {id: id + '_tagsinput', class: 'tagsinput'}).append(
				$('<div>', {id: id + '_addTag'}).append(
					settings.interactive ? $('<input>', {id: id + '_tag', class: 'tag-input', value: '', placeholder: settings.placeholder}) : null
				)
			);

			$(markup).insertAfter(this);

			$(data.holder).css('width', settings.width);
			$(data.holder).css('min-height', settings.height);
			$(data.holder).css('height', settings.height);

			if ($(data.real_input).val() !== '') {
				$.fn.tagsInput.importTags($(data.real_input), $(data.real_input).val());
			}
			
			// Stop here if interactive option is not chosen
			if (!settings.interactive) return;
			
			$(data.fake_input).val('');
			$(data.fake_input).data('pasted', false);
			
			$(data.fake_input).on('focus', data, function(event) {
				$(data.holder).addClass('focus');
				
				if ($(this).val() === '') {
					$(this).removeClass('error');
				}
			});
			
			$(data.fake_input).on('blur', data, function(event) {
				$(data.holder).removeClass('focus');
			});

			if (settings.autocomplete !== null && jQuery.ui.autocomplete !== undefined) {
				$(data.fake_input).autocomplete(settings.autocomplete);
				$(data.fake_input).on('autocompleteselect', data, function(event, ui) {
					$(event.data.real_input).addTag(ui.item.value, {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				});
				
				$(data.fake_input).on('keypress', data, function(event) {
					if (_checkDelimiter(event)) {
						$(this).autocomplete("close");
					}
				});
			} else {
				$(data.fake_input).on('blur', data, function(event) {
					$(event.data.real_input).addTag($(event.data.fake_input).val(), {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				});
			}
			
			// If a user types a delimiter create a new tag
			$(data.fake_input).on('keypress', data, function(event) {
				if (_checkDelimiter(event)) {
					event.preventDefault();
					
					$(event.data.real_input).addTag($(event.data.fake_input).val(), {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				}
			});
			
			$(data.fake_input).on('paste', function () {
				$(this).data('pasted', true);
			});
			
			// If a user pastes the text check if it shouldn't be splitted into tags
			$(data.fake_input).on('input', data, function(event) {
				if (!$(this).data('pasted')) return;
				
				$(this).data('pasted', false);
				
				var value = $(event.data.fake_input).val();
				
				value = value.replace(/\n/g, '');
				value = value.replace(/\s/g, '');
				
				var tags = _splitIntoTags(event.data.delimiter, value);
				
				if (tags.length > 1) {
					for (var i = 0; i < tags.length; ++i) {
						$(event.data.real_input).addTag(tags[i], {
							focus: true,
							unique: settings.unique
						});
					}
					
					return false;
				}
			});
			
			// Deletes last tag on backspace
			data.removeWithBackspace && $(data.fake_input).on('keydown', function(event) {
				if (event.keyCode == 8 && $(this).val() === '') {
					 event.preventDefault();
					 var lastTag = $(this).closest('.tagsinput').find('.tag:last > span').text();
					 var id = $(this).attr('id').replace(/_tag$/, '');
					 $('#' + id).removeTag(encodeURI(lastTag));
					 $(this).trigger('focus');
				}
			});

			// Removes the error class when user changes the value of the fake input
			$(data.fake_input).keydown(function(event) {
				// enter, alt, shift, esc, ctrl and arrows keys are ignored
				if (jQuery.inArray(event.keyCode, [13, 37, 38, 39, 40, 27, 16, 17, 18, 225]) === -1) {
					$(this).removeClass('error');
				}
			});
		});

		return this;
	};
	
	$.fn.tagsInput.updateTagsField = function(obj, tagslist) {
		var id = $(obj).attr('id');
		$(obj).val(tagslist.join(_getDelimiter(delimiter[id])));
	};

	$.fn.tagsInput.importTags = function(obj, val) {
		$(obj).val('');
		
		var id = $(obj).attr('id');
		var tags = _splitIntoTags(delimiter[id], val); 
		
		for (i = 0; i < tags.length; ++i) {
			$(obj).addTag(tags[i], {
				focus: false,
				callback: false
			});
		}
		
		if (callbacks[id] && callbacks[id]['onChange']) {
			var f = callbacks[id]['onChange'];
			f.call(obj, obj, tags);
		}
	};
	
	var _getDelimiter = function(delimiter) {
		if (typeof delimiter === 'undefined') {
			return delimiter;
		} else if (typeof delimiter === 'string') {
			return delimiter;
		} else {
			return delimiter[0];
		}
	};
	
	var _validateTag = function(value, inputSettings, tagslist, delimiter) {
		var result = true;
		
		if (value === '') result = false;
		if (value.length < inputSettings.minChars) result = false;
		if (inputSettings.maxChars !== null && value.length > inputSettings.maxChars) result = false;
		if (inputSettings.limit !== null && tagslist.length >= inputSettings.limit) result = false;
		if (inputSettings.validationPattern !== null && !inputSettings.validationPattern.test(value)) result = false;
		
		if (typeof delimiter === 'string') {
			if (value.indexOf(delimiter) > -1) result = false;
		} else {
			$.each(delimiter, function(index, _delimiter) {
				if (value.indexOf(_delimiter) > -1) result = false;
				return false;
			});
		}
		
		return result;
	};
 
	var _checkDelimiter = function(event) {
		var found = false;
		
		if (event.which === 13) {
			return true;
		}

		if (typeof event.data.delimiter === 'string') {
			if (event.which === event.data.delimiter.charCodeAt(0)) {
				found = true;
			}
		} else {
			$.each(event.data.delimiter, function(index, delimiter) {
				if (event.which === delimiter.charCodeAt(0)) {
					found = true;
				}
			});
		}
		
		return found;
	 };
	 
	 var _splitIntoTags = function(delimiter, value) {
		 if (value === '') return [];
		 
		 if (typeof delimiter === 'string') {
			 return value.split(delimiter);
		 } else {
			 var tmpDelimiter = '∞';
			 var text = value;
			 
			 $.each(delimiter, function(index, _delimiter) {
				 text = text.split(_delimiter).join(tmpDelimiter);
			 });
			 
			 return text.split(tmpDelimiter);
		 }
		 
		 return [];
	 };
})(jQuery);


$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + 
        '"> ' + '<img src="' + $(this).attr("data-image") + '"/>' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});

function valueChanged() {
  if($('.coupon_question').is(":checked"))   
    $(".answer_list_guard").show();
  else
    $(".answer_list_guard").hide();
};
</script>

 <script type="text/javascript">
 
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
			
        </script>
<!-- page script --> 
<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script> 
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
<!-- Bootstrap WYSIHTML5 --> 
<script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 
<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
				 CKEDITOR.replace('editor2');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
			
			var imgUpload = document.getElementById('upload_imgs')
  , imgPreview = document.getElementById('img_preview')
  , imgUploadForm = document.getElementById('img-upload-form')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, false);
imgUploadForm.addEventListener('submit', function (e) {
  e.preventDefault();
  alert('Images Uploaded! (not really, but it would if this was on your website)');
}, false);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;
  
  if(!!totalFiles) {
    imgPreview.classList.remove('quote-imgs-thumbs--hidden');
    previewTitle = document.createElement('p');
    previewTitle.style.fontWeight = 'bold';
    previewTitleText = document.createTextNode(totalFiles + ' Total Images Selected');
    previewTitle.appendChild(previewTitleText);
    imgPreview.appendChild(previewTitle);
  }
  
  for(var i = 0; i < totalFiles; i++) {
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    imgPreview.appendChild(img);
  }
}
	
	
	
		
			
        </script>
        
</body>
</html>
