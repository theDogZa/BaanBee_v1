/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

// // Define the string
// var string = 'Hello World!';

// // Encode the String
// var encodedString = Base64.encode(string);
// console.log(encodedString); // Outputs: "SGVsbG8gV29ybGQh"

// // Decode the String
// var decodedString = Base64.decode(encodedString);
// console.log(decodedString); // Outputs: "Hello World!"
$(document).ready(function () {
	
});
	var dataphp = [];
	
	// // TODO: get Language,config for php
	$.getJSON('/home/datatojs', function (data) {
		dataphp = data;
		// console.log("=============" + dataphp['lang_noti_search_title']);
	});

	// TODO: show Panel on load Success
	$(window).on("load", function () {
		//console.log("window loaded");
		$("#panel_list").show("slide");
		setTimeout(function () {
			$("#panel_list").removeClass("panel_hide");
		}, 1000);
	});

	// TODO: check data to load page open from advanced search , and form search
	$(window).on("load", function () {
		var fields = $('#from-advanced-search').serializeArray();
		for (var i = 0; i < fields.length; i++) {

			if (fields[i].value) {

				$('#panel_advanced_search').show("slide");
				$('#input-search').toggleDisabled();
				$('#btn-search').toggleDisabled();
				$('#input-search').toggleClass("search search-disabled");
				$('#btn-search').toggleClass("btn-default btn-info");
				$('.btn-panel-advanced-search').toggleClass("btn-default  btn-info");
				$("i", '.btn-panel-advanced-search').toggleClass("fa-search-plus fa-search-minus");

				noti(dataphp['noti_adv_search_title'], dataphp['lang_adv_search_success'],'success');
				break;
			}
		}
	});

	$(window).on("load", function () {
		if ($('#input-search').val()) {
			noti(dataphp['lang_noti_search_title'], dataphp['lang_search_success'], 'success');
		}
	});

	// $(document).on('focus', '.select2.select2-container', function (e) {
	// 	// only open on original attempt - close focus event should not fire open
	// 	if (e.originalEvent && $(this).find(".select2-selection--single").length > 0) {
	// 		$(this).siblings('select').select2('open');
	// 	}
	// });

	$(document).on('focus', '.select2', function (e) {
		if (e.originalEvent) {
			$(this).siblings('select').select2('open');
		}
	});

$(function () {
	
	// TODO: delay submit for show  Processing Bar
	$('.form-process').submit(function (e) {
		var form = this;
		e.preventDefault();
		setTimeout(function () {
			form.submit();
		}, 2500);

		 ProcessingDialog.show();
	});

	// TODO: check data to submit from search
	$('.btn-logoff').click(function () {
		
		var Confirm = ConfirmYesNo(dataphp['lang_confirm_title_logout'], dataphp['lang_confirm_logout']);
		Confirm.then(function (result) {
			$('#logout-form').submit();
		});
		return false;
	});

	// TODO: check data to submit from search
	$('.btn-search').click(function () {
		if (!$('#input-search').val()) {
			return false;
		}
	});

	// TODO: btn-reset for advanced-search
	$('#from-advanced-search .btn-reset').click(function () {
		var $_from = '#' + $(this).closest("form").attr('id');
		$($_from).find('input:radio').each(function () {

			var idAll = '#' + $(this).attr('name') + '_all';
			$(this).iCheck('uncheck');
			setTimeout(function () {
				$(idAll).attr('checked', 'checked');
				$(idAll).iCheck('update');
			}, 300);
		});

		$($_from).find('input:text, input:hidden, input:password, input:file, textarea').attr('value', '');
		$($_from).find('input[type=number]').attr('value', '');
		$($_from).find('select').select2("val", "");
		$($_from).find('select > option').removeAttr('selected');
		$($_from).find('select').attr('value', '');

	});


	// TODO: check data on submit from advanced search
	$(document).on('click', '#btn-advanced-search', function (e) {
		$('#from-advanced-search input').each(function () {
			if ($.trim(this.value).length) {
				$('#from-advanced-search').submit();
				return false;
			}
		});
		return false;
	});

	// TODO: check data on submit from advanced search
	// $(document).on('click', '#model-btn-advanced-search', function (e) {
	// 	$('#from-advanced-search input').each(function () {
	// 		if ($.trim(this.value).length) {
	// 			$('#from-advanced-search').submit();
	// 			return false;
	// 		}		
	// 	});
	// 	return false;
	// });

	// TODO: Open or Close  panel advanced search in all index page
	$(document).on('click', '.btn-panel-advanced-search', function (e) {
	//$('.btn-panel-advanced-search').click(function () {

		$(this).toggleClass("btn-default  btn-info");
		$('#input-search').toggleDisabled();
		$('#btn-search').toggleDisabled();
		$('#input-search').toggleClass("search search-disabled");
		$('#btn-search').toggleClass("btn-default btn-info");
		$('#input-search').val('');
		$('#panel_advanced_search').toggle("slide");
		$("i", this).toggleClass("fa-search-plus fa-search-minus");

		return false;
	});

	//TODO: check all to check box
	$(document).on('click', '#check_all', function (e) {

		var claAll = $(this).data('class-all');
		var status = $(this).prop("checked");

		$("."+claAll).each(function () {
			 if (status === true) {
			 	$(this).prop('checked', true);
			 } else {
			 	$(this).prop('checked', false);
			 }
		});
	});

	//TODO: row-checkbox-list checkbox trigger
	$(document).on('click', '.row-checkbox-list', function (e) {

		var itemid = $(this).data('id');
		$('#item_id_' + itemid).trigger('click');

	});

	//TODO: chk-item-list checkbox trigger
	$(document).on('click', '.chk-item-list', function (e) {
		$(this).trigger('click');
	});

	// TODO: check data to submit from search
	// $("#form-change-password").submit(function (e) {
	// 	var Confirm = ConfirmYesNo('', 'Are you sure you want to change this?..');
	// 	Confirm.then(function (result) {
	// 		if (result) {
	// 			setTimeout(function () {
	// 				$("#form-change-password").submit();	
	// 			}, 2500);

	// 			ProcessingDialog.show('Processing...');
						
	// 		}
	// 	});
	// 	return false;
	// });

	// TODO: This is some kind of easy fix, maybe we can improve this	
    $('.switch_radio_save').click(function() {		
		var val_checked = $(this).filter(':checked').val();   
		var id = $(this).data('id');
		var action = $("#form").prop('action')+'/'+id;
        var _token = $("#form").find("input[name='_token']").val();
		var Confirm = ConfirmYesNo(dataphp['lang_confirm_title_edit'], dataphp['lang_confirm_edit']);
        Confirm.then(function (result) {
			if(result){
                ProcessingDialog.show();
                $.post(action,{'_method':'PATCH','_token':_token,'active':val_checked}).done(function(data) {
                    if(data){
                        setTimeout(function () {
							ProcessingDialog.hide();
						}, 1000);
						
						setTimeout(function () {
							// var message = '<i class="fa fa-check" aria-hidden="true"></i> Save successfully';
							// StatusDialog.show('Successful...',message, {dialogSize: 'm'});
							noti(dataphp['lang_noti_title_update'], dataphp['lang_noti_update_success']);
                        }, 1100);
                        
						// setTimeout(function () {
						// 	StatusDialog.hide();
                        // }, 3000);

                        setTimeout(function () {
							$(rowitem).fadeOut(2000,function(){$(this).remove();});
                        }, 3200);
                    }
                });
            }
        });       
    });

	// TODO: Del Row Data	
    $('.btn-del').click(function() {
		
        var id = $(this).data('id');
        var action = $("#form").prop('action')+'/'+id;
        var _token = $("#form").find("input[name='_token']").val();
		var rowitem = '#row-item-id-'+id;
		
        var Confirm = ConfirmYesNo(dataphp['lang_confirm_title_del'], dataphp['lang_confirm_del']);
        Confirm.then(function (result) {
			if(result){
                ProcessingDialog.show();
                $.post(action,{'_method':'DELETE','_token':_token}).done(function(data) {
                    if(data){
	
                        setTimeout(function () {
							ProcessingDialog.hide();
						}, 1000);
						
						setTimeout(function () {
							noti(data.title, data.message, data.type);
                        }, 1100);
                        
						if (data.del_status){
							setTimeout(function () {
								$(rowitem).fadeOut(1600,function(){$(this).remove();});
							}, 2000);
						}
   
                    }
                });
            }
        });       
	});


	//------------------------------------  in model ----------------------------------------

	//TODO: class model main
	var body_model = '.model-main .modal-dialog .modal-content .modal-body';

	//TODO: a tag in side model
	$(document).on('click', body_model + " a", function (e) {
		e.preventDefault();

		var url_q = $(this).attr('href');

		$.get(url_q, function (data) {
			$(body_model).html(data);
		});
		return false;

	});

	//TODO: search in side model
	$(document).on('click', body_model + " .btn-search", function (e) {
		if (!$('#input-search').val()) {
			return false;
		} else {
			var dataJson = [];
			// var dataJson = [{
			// 	"item": "a1",
			// 	"val": 1
			// }, {
			// 	"item": "a2",
			// 	"val": 2
			// }];
			// var aa = $('.chk-item-list:checked').serializeArray();
			var $_from = $('#form-list-items').serializeArray();
			$($_from).each(function () {
				
				console.log(this['name']);
			});


		//	console.log(dataJson);
			var url_q = $('#q-search').attr('action') + '?' + $('#q-search').serialize();
			$.get(url_q, { 'json': dataJson }, function (data) {
				$(body_model).html(data);
			});
		}
		return false;
	});

	//TODO: advanced-search in side model
	$(document).on('click', body_model + " #btn-advanced-search", function (e) {
		var $_from = $('#from-advanced-search');
		var url_q = $_from.attr('action') + '?' + $_from.serialize();
		$.get(url_q,{'json':'sss'}, function (data) {
			$(body_model).html(data);
			$('#panel_advanced_search').show("slide");
		});

		return false;
	});

	// TODO: btn-reset for advanced-search
	$(document).on('click', body_model + ' #from-advanced-search .btn-reset', function (e) {
		
		var $_from = '#from-advanced-search';d
		$($_from).find('input:radio').each(function () {

			var idAll = '#' + $(this).attr('name') + '_all';
			$(this).iCheck('uncheck');
			setTimeout(function () {
				$(idAll).attr('checked', 'checked');
				$(idAll).iCheck('update');
			}, 300);
		});

		$($_from).find('input:text, input:hidden, input:password, input:file, textarea').attr('value', '');
		$($_from).find('input[type=number]').attr('value', '');
		$($_from).find('select').select2("val", "");
		$($_from).find('select > option').removeAttr('selected');
		$($_from).find('select').attr('value', '');

	});
	
});//.$(function ()

// TODO: function Notification message
function noti(title,msg,type){
	
	if (title==''){
		title = 'Notification';
	}
	if (type == '') {
		type = 'success';
	}
	new PNotify({
		title: title,
		text: msg,
		type: type,
		styling: 'bootstrap3',
		delay: 3000
	})
	// var stack_topleft = { "dir1": "down", "dir2": "right", "push": "top" };
	// var stack_bottomleft = { "dir1": "right", "dir2": "up", "push": "top" };
	// var stack_bar_top = { "dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0 };
	// var stack_bar_bottom = { "dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0 };

	// new PNotify({
	// 	title: "Over Here",
	// 	text: "Check me out. I'm in a different stack.",
	// 	addclass: "stack-bar-top",
	// 	cornerclass: "",
	// 	width: "100%",
	// 	stack: stack_bar_top,
	// 	type: "success"
	// })
	//new PNotify(opts);
}


function ConfirmYesNo(title, msg) {
	  
    var dfd = jQuery.Deferred();
    var $confirm = $(
      '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
      '<div class="modal-dialog modal-m">' +
      '<div class="modal-content">' +
          '<div class="modal-header">'+
          ' <h4 class="modal-title" id="myModalLabel" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span id="confirmtitle">Confirmation</span></h4>'+
          '</div>' +
          '<div class="modal-body" >' +
              ' <i class="fa fa-exclamation" aria-hidden="true"></i>  <span id="confirmMessage">Are you sure you want to change this? </span> ' +
          '</div>' +
          '<div class="modal-footer">'+
             ' <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-Cancel" style="margin-bottom: 0px;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>'+
             ' <button type="button" class="btn btn-primary" id="btn-confirm"><i class="fa fa-check" aria-hidden="true"></i> Confirm</button>'+
           ' </div>'+
      '</div></div></div>');
  
	if(title){
		$confirm.find('h4').text(title);
	}
	if(msg){
		$confirm.find('#confirmMessage').html(msg);
	}
  
    $confirm.modal('show');
    
    $confirm.find('#btn-confirm').off('click').click(function () {
      $confirm.modal('hide');
      dfd.resolve(true);
      return true;
    });
    
    $confirm.find('#btn-Cancel').off('click').click(function () {
      $confirm.modal('hide');
      return false;
    });
    
    return dfd.promise();
    
}//.ConfirmYesNo

function ProgressBar(ctime) {
	var elem = document.getElementById("progress-bar");
	var width = 1;
	var id = setInterval(frame, ctime);

	function frame() {
		if (width >= 100) {
			clearInterval(id);
			ProcessingDialog.hide();		
		} else {
			width++;
			$('#count').text(width);
			elem.style.width = width+'%';
		}
	}
}

var ProcessingDialog = ProcessingDialog || (function ($) {
    'use strict';

	var $dialog = $(

		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style=" padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
		'<div class="modal-body">' +
		'<div id="title-bar"><h4><span id="title"></span> <span id="count"></span> <span id="complete"></span></h4></div>' +
		'<div id="progress-bar" class="progress-bar-success"></div>' +
		'</div></div></div></div>'
	);

	return {
		show: function (message, options) {
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				//message = dataphp['lang_progress_message'];
				//complete = dataphp['lang_progress_message_complete'];
			}
			var settings = $.extend({
				dialogSize: 'm',
				ctime: 10,
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			var message = dataphp['lang_progress_message'];
			var complete = dataphp['lang_progress_message_complete'];

			// Configuring dialog
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('#title-bar #title').text(message);
			$dialog.find('#title-bar #complete').text(complete);
			// Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			
			// Opening dialog
			$dialog.modal();
			setTimeout(function () {
				ProgressBar(settings.ctime);
			}, 400);
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			$dialog.find('#title-bar #title').text(dataphp['lang_progress_message_done']);
			$dialog.fadeOut(1000);
			setTimeout(function () {
				$dialog.modal('hide');
			}, 1000);
		}
	};

})(jQuery);//.ProcessingDialog

var modalDialog = modalDialog || (function ($) {
	'use strict';

	var $dialog = $(
		'<div class="modal fade model-main" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:0%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-lg">' +
		'<div class="modal-content">' +
		'<div class="modal-header">' +
		'<h4 class="modal-title" id="myModalLabel" ><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span id="header"></span></h4>' +
		'</div>' +
		'<div class="modal-body" >' +
		'</div>' +
		'<div class="modal-footer">' +
		'<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-Cancel" aria-label="close" style="margin-bottom: 0px;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>' +
		'<button type="button" class="btn btn-primary" id="btn-confirm"><i class="fa fa-check" aria-hidden="true"></i> Confirm</button>' +
		'</div>' +
		'</div></div></div>');

	return {
		show: function (header, body, options) {
			// Assigning defaults
			if (typeof options === 'undefined') {
				options = {};
			}

			if (typeof header === 'undefined') {
				header = 'No Information !';
			}

			if (typeof body === 'undefined' || typeof body === '') {
				body = 'No Information !';
			}
			var settings = $.extend({
				dialogSize: 'm',
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			// Configuring dialog
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('#header').html(header);
			$dialog.find('.modal-body').html(body);

			//Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			// Opening dialog
			$dialog.modal();
			// setTimeout(function () {
			// 	ProgressBar(settings.ctime);
			// }, 400);

			$dialog.find('#btn-confirm').click(function () {

				var fields = $dialog.find('#form-list-items input').serializeArray();

				
				 console.log(fields);
				

				$dialog.modal('hide');

			});
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			// $dialog.fadeOut(1000);
			// setTimeout(function () {
				$dialog.modal('hide');
				console.log('cloe');
			// }, 1000);
		}

		
	};

	// $dialog.find('#btn-Cancel').off('click').click(function () {
	// 	$dialog.modal('hide');
	// 	return false;
	// });
})(jQuery); //.modalDialog

function dataNotChangeMessage() {

	noti(dataphp['lang_noti_title_data_not_change'], dataphp['lang_noti_data_not_change'], 'warning');
}



// var StatusDialog = StatusDialog || (function ($) {
    
// 	'use strict';
// 	var $dialog = $(
// 		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
// 		'<div class="modal-dialog modal-m">' +
// 		'<div class="modal-content">' +
// 			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
// 			'<div class="modal-body">' +
// 				'<i class="fa fa-check" aria-hidden="true"></i> <span> Save successfully</span>' +
// 			'</div>' +
// 		'</div></div></div>');

// 	return {
// 		show: function (header,message, options) {
// 			// Assigning defaults
// 			if (typeof options === 'undefined') {
// 				options = {};
// 			}
// 			if (typeof header === 'undefined') {
// 				header = 'Save successfully';
// 			}
			
// 			if (typeof message === 'undefined' && typeof message === '') {
// 				message = '<i class="fa fa-check" aria-hidden="true"></i> Save successfully';
// 			}
// 			var settings = $.extend({
// 				dialogSize: 'm',
				
// 				onHide: null // This callback runs after the dialog was hidden
// 			}, options);

// 			// Configuring dialog
// 			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
// 			//$dialog.find('h3').text(message);
// 			$dialog.find('h3').html(header);
// 			$dialog.find('.modal-body').html(message);
			
// 			// Adding callbacks
// 			if (typeof settings.onHide === 'function') {
// 				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
// 					settings.onHide.call($dialog);
// 				});
// 			}
// 			// Opening dialog
// 			$dialog.modal();
// 		},
// 		/**
// 		 * Closes dialog
// 		 */
// 		hide: function () {
// 			$dialog.modal('hide');
// 		}
// 	};

// })(jQuery);//.StatusDialog


$('#toggleFullScreen').click(function() {
	if (!document.fullscreenElement &&    // alternative standard method
		!document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
	  if (document.documentElement.requestFullscreen) {
		document.documentElement.requestFullscreen();
	  } else if (document.documentElement.mozRequestFullScreen) {
		document.documentElement.mozRequestFullScreen();
	  } else if (document.documentElement.webkitRequestFullscreen) {
		document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
	  }
	} else {
	  if (document.cancelFullScreen) {
		document.cancelFullScreen();
	  } else if (document.mozCancelFullScreen) {
		document.mozCancelFullScreen();
	  } else if (document.webkitCancelFullScreen) {
		document.webkitCancelFullScreen();
	  }
	}
});

$.fn.toggleDisabled = function () {
	return this.each(function () {
		this.disabled = !this.disabled;
	});
};


//----------------------------------------------------check for close windows
//var validNavigation = 'false';

// function disableF5(e) { 
//   if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82){
//     validNavigation = 'true5'; 
//   }
// };

// function wireUpEvents() {

//   // Attach the event keypress to exclude the F5 refresh
//   $(document).bind('keypress', function(e) {
//     if (e.keyCode == 116){
//       validNavigation = 'true1';
//     }
//   });

//   // Attach the event click for all links in the page
//   $("a").bind("click", function() {
//     validNavigation = 'true2';
//   });

//   // Attach the event submit for all forms in the page
//   $("form").bind("submit", function() {
//     validNavigation = 'true3';
//   });

//   // Attach the event click for all inputs in the page
//   $("input[type=submit]").bind("click", function() {
//     validNavigation = 'true4';
//   });

// }

// // Wire up the events as soon as the DOM tree is ready
// $(document).ready(function() {
//   $(document).on("keydown", disableF5);
//   wireUpEvents();
// });

// window.onbeforeunload = WindowCloseHanlder;
// function WindowCloseHanlder(e)
// {	

//         var id =14;
//         var action = $("#form").prop('action')+'/'+id;
//         var _token = $("#form").find("input[name='_token']").val();
//        $.post(action,{'_method':'PATCH','_token':_token,'status':'1','check':validNavigation}).done(function(data,status) {
//                     console.log(data);
//         });

// }




/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 13/04/2018 23:26
 * Version : v.10000
 *
 */

