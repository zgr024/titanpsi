// JavaScript Document
var saved 			 = true,
	deleted_articles = [],
	deleted_details  = [];
	
$(function(){
	
	window.onbeforeunload = function(){
		if (!saved) return "The post has not yet been saved...";
	}
	
	$('.froala').livequery(function(){
		
		$(this)
			.editable({
				inlineMode: false,
				minHeight: 400,
	//			theme: 'dark',
				buttons: ["bold", "italic", "underline", "strikeThrough", "subscript", "superscript", "fontFamily", "fontSize", "color", "formatBlock", "blockStyle", "inlineStyle", "align", "insertOrderedList", "insertUnorderedList", "outdent", "indent", "selectAll", "createLink", "insertImage", "insertVideo", "table", "undo", "redo", "html", "insertHorizontalRule", "removeFormat", "fullscreen"],
				imageUploadURL: '/admin/edit-post/ajax/upload-image',
				imageUploadParams: {id: "body"},
				imageDeleteURL: '/admin/edit-post/ajax/delete-image'
			})
			
			.on('editable.afterRemoveImage', function (e, editor, $img) {
				// Set the image source to the image delete params.
				editor.options.imageDeleteParams = {src: $img.attr('src')};
		
				// Make the delete request.
				editor.deleteImage($img);
			 })
		
			  // Catch image delete successful.
			.on('editable.imageDeleteSuccess', function (e, editor, data) {
				// ...
			})
		
			  // Catch image delete error.
			.on('editable.imageDeleteError', function (e, editor, error) {
				// ...
			})
		;
		
		setTimeout(function(){
			$('.froala-box div a:last-of-type').each(function() {
				if ($(this).attr('href')=='http://editor.froala.com') $(this).parent().fadeOut('fast');
			})
		},100);
	});
	
	$('.froala2').livequery(function(){
		
		$(this)
			.editable({
				inlineMode: false,
				height: 100,
				//maxCharacters: 120,
	//			theme: 'dark',
				buttons: ["bold", "italic", "underline", "strikeThrough", "subscript", "superscript", "fontFamily", "fontSize", "color", "formatBlock", "blockStyle", "inlineStyle", "align", "insertOrderedList", "insertUnorderedList", "outdent", "indent", "selectAll", "createLink", "table", "undo", "redo", "html", "insertHorizontalRule", "removeFormat", "fullscreen"]
			})
		
		;
		
		setTimeout(function(){
			$('.froala-box div a:last-of-type').each(function() {
				if ($(this).attr('href')=='http://editor.froala.com') $(this).parent().fadeOut('fast');
			})
		},300);
	});
	
	
});

$('#body')

	.on('click','#delete',function(){
		$.confirm({
			title: 'Confirm!',
			content: 'Are you sure you want to delete this post?',
			confirmButton: 'Yes... Delete the Post',
			cancelButton: 'NO... Don\'t Delete',
			autoClose: 'cancel|6000',
			backgroundDismiss: false,
			confirm: function(){
				$.ajax({
					url: '/admin/ajax/delete-post/'+$('#blog_post_ide').val(),
					data: data,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function(res) {
						if ($.trim(res) == 'success') location.href = '/admin';
					}
				});
			}
		});
	})

	.on('click','.save',function(e) {
		e.preventDefault();
		if ($(this).hasClass('clicked')) {
			$.alert({
				title: 'Warning!',
				content: 'The edits have already been saved!',
			});
			return false;
		}
		
		$('.saveMessage').html('').removeClass('aql_saved').removeClass('aql_error');
		var data = new FormData(document.getElementById("postForm"));
		data.append('deleted_articles', deleted_articles);
		data.append('deleted_details', deleted_details);

		var ide = $('#blog_post_ide').val();
		if (ide) ide = '/'+ide;
		$(this).addClass('clicked');
		$.ajax({
			url: '/admin/ajax/save-post'+ide,
			data: data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType: 'json',
			success: function(res) {
				if (res.success) {
					$('.saveMessage').html('saved...').addClass('aql_saved');
					$('.save').fadeOut('fast');
					setTimeout(function() {
						location.reload();					
					},2000);
					saved = true;
					$('input:file').each(function(){
						switch($(this).attr('name')) {
							case 'carousel':
							case 'blogroll':
							case 'sidebar':
							case 'blogroll':
							case 'have_to':
								var type = $(this).attr('name');
								$(this).replaceWith('<a class="change-image" data-type="'+type+'">change image</a>');
								break;
							default:
								if ($(this).val()) $(this).remove();
								break;
						}
						if ($(this).val()) $(this).remove();
					});
				}
				else {
					$('.saveMessage').html('error saving...').addClass('aql_error');
				}
			},
			error: function(res){
				$('.saveMessage').html(res).addClass('aql_error');
			}
		});		
	})
	
	.on('click','#edit-post',function() {
		if (!$('#blog_post_ide').val()) {
			if (confirm("This post hasn't been saved.\n\rAre you sure you want to start over?")) location.href = '/admin/edit-post';
		}
		else {
			location.href = '/admin/edit-post';
		}
	})
	
	.on('keyup','input[name=title]',function() {
		var slug = $(this).val().toSlug();
		$('input[name=slug]').val(slug);
	})
	
	.on('change','input[name=blogroll]',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.className = 'img-responsive';
				img.width = 600;
				
				$this.siblings('.imageContainer').html('').append(img);
				
				if ($this.siblings('.inputContainer').html() == '') {
				
					$this.siblings('.inputContainer')
						.append('<a class="remove">remove item</a>')
						.append('<div class="clear"></div>')
					;
				}
				
			};

			reader.readAsDataURL(this.files[0]);
			$this.fadeOut('fast');
		}
	})
	
	.on('change','input[name=carousel]',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.className = 'img-responsive';
				img.width = 600;
				
				$this.siblings('.imageContainer').html('').append(img);
				
				if ($this.siblings('.inputContainer').html() == '') {
				
					$this.siblings('.inputContainer')
						.append('<a class="remove">remove item</a>')
						.append('<div class="clear"></div>')
					;
				}
				
			};

			reader.readAsDataURL(this.files[0]);
			$this.fadeOut('fast');
		}
	})
	
	.on('change','.styleUpload',function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			var length = $('.styleContainer').length;
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.width = 400;
				img.className = 'img-responsive';
				$this.siblings('.imageContainer')
					.html(img)
					.append('<a class="remove">remove style tip</a>')
					.append('<div class="clear"></div>')
					.append('<input class="form-control styleName" name="style['+length+'][style_name]" placeholder="Style Name">')
					.append('<textarea class="form-control styleDesc" name="style['+length+'][style_description]" placeholder="Style Description"></textarea>')
					.append('<input class="form-control shoppingName" name="style['+length+'][name][]" placeholder="Product Name">')
					.append('<input type="number" class="form-control shoppingPrice" name="style['+length+'][price][]" placeholder="Price">')
					.append('<input class="form-control shoppingLink" name="style['+length+'][description][]" placeholder="Product Description">')
					.append('<input class="form-control shoppingLink" name="style['+length+'][href][]" placeholder="Link">')
					.append('<input class="form-control shoppingLink" name="style['+length+'][href_display][]" placeholder="Link Display">')
					.append('<a class="addItem">+</a>')
					.data('length',length)
				;
				if (length < 4) {
					$this.closest('.row')
						.append('<div class="uploaderContainer col-md-3 text-center"><div class="imageContainer styleContainer" data-length="'+length+'"></div><input type="file" name="style[]"></div>')
					;
				}
				$this.fadeOut('fast');
			};

			reader.readAsDataURL(this.files[0]);
		}
	})
	
	.on('click','.removeItem',function(){
		if (!confirm('Are you sure you want to remove this product?')) return false;
		$(this).prevUntil('hr').remove();
		$(this).prev('hr').remove();
		if ($(this).data('ide')) deleted_details.push($(this).data('ide'));
		//console.log(deleted_details);
		$(this).remove();
	})
	
	.on('click','.addItem',function() {
		var $imageContainer = $(this).closest('.imageContainer');
		var length = $imageContainer.data('length');
		$imageContainer
			.append('<div class="clear"></div>')
			.append('<hr>')
			.append('<input class="form-control shoppingName" name="style['+length+'][name][]" placeholder="Product Name">')
			.append('<input type="number" class="form-control shoppingPrice" name="style['+length+'][price][]" placeholder="Price">')
			.append('<input class="form-control shoppingLink" name="style['+length+'][description][]" placeholder="Product Description">')
			.append('<input class="form-control shoppingLink" name="style['+length+'][href][]" placeholder="Link">')
			.append('<input class="form-control shoppingLink" name="style['+length+'][href_display][]" placeholder="Link Display">')
			.append('<a class="addItem">+</a> <a class="removeItem">-</a>')
		;
	})
	
	.on('change','input[name="marry[]"]',function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.width = 150;
				img.className = 'img-responsive';
				$this.siblings('.imageContainer')
					.html(img)
					.append('<a class="remove">remove item</a>')
					.append('<div class="clear"></div>')
					.append('<input class="form-control shoppingName" name="marry_name[]" placeholder="Name">')
					.append('<input type="number" class="form-control shoppingPrice" name="marry_price[]" placeholder="Price">')
					.append('<input class="form-control shoppingLink" name="marry_href[]" placeholder="Link">')					
				;
				if ($('input[name="marry_name[]"]').length < 30) {
					$this.closest('.row')
						.append('<div class="uploaderContainer col-md-4 text-center"><div class="imageContainer marryContainer"></div><input type="file" name="marry[]"></div>')
					;
				}
				$this.fadeOut('fast');
			};

			reader.readAsDataURL(this.files[0]);
		}
	})
	
	.on('change','input[name="skirt[]"]',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);

			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.width = 150;
				img.className = 'img-responsive';
				$this.siblings('.imageContainer')
					.html(img)
					.append('<a class="remove">remove item</a>')
					.append('<div class="clear"></div>')
					.append('<input class="form-control shoppingName" name="skirt_name[]" placeholder="Name">')
					.append('<input type="number" class="form-control shoppingPrice" name="skirt_price[]" placeholder="Price">')
					.append('<textarea class="form-control shoppingDesc" name="skirt_description[]" placeholder="Description"></textarea>')
					.append('<input class="form-control shoppingLink" name="skirt_href[]" placeholder="Link">')
				;
				if ($('input[name="skirt_name[]"]').length < 30) {
					$this.closest('.row').append('<div class="uploaderContainer col-md-4 text-center"><div class="imageContainer skirtContainer"></div><input type="file" name="skirt[]"></div>');
				}
				$this.fadeOut('fast');
			};

			reader.readAsDataURL(this.files[0]);
		}
	})
	
	.on('change','input[name="have_to"]',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			var orientation;
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.width = 600;
				img.className = 'img-responsive';
				if (img.width < img.height) orientation = 'portrait';
				else orientation = 'landscape';
				
				var bubble1 = '<div class="leftBubble" style="top: 20%"><span></span></div>';
            	var bubble2 = '<div class="rightBubble" style="top: 20%"><span></span></div>';											
				$this.siblings('.imageContainer')
					.html(bubble1)
					.append(img)
					.append(bubble2)
				;
				$this.siblings('.inputContainer')
					.append('<a class="remove">remove item</a>')
					.append('<div class="clear"></div>')
					.append('<input class="form-control bubbleInput" maxlength="110" name="left_bubble" id="left_bubble" placeholder="Left Bubble Text">')
					.append('<input type="number" class="form-control percent" id="left_top" name="left_top" min="1" max="99" value="20" placeholder="Left Top %"> % from top')
					.append('<input class="form-control bubbleInput" maxlength="110" name="right_bubble" id="right_bubble" placeholder="Right Bubble Text">')
					.append('<input type="number" class="form-control percent" id="right_top" name="right_top" min="1" max="99" value="20" placeholder="Right Top %"> % from top')
					.append('<input class="form-control product" id="product" name="product" placeholder="Product">')
					.append('$<input class="form-control price" id="price" name="price" placeholder="price">')
					.append('<input class="form-control link" id="href" name="href" placeholder="Link">')
					.append('<input class="form-control link_disp" id="href_disp" name="href_disp" placeholder="Link Display">')
				;
				
				$('#orientation').val(orientation)
				
			};

			reader.readAsDataURL(this.files[0]);
			$this.fadeOut('fast');
		}
	})
		
	.on('change','input[name="sidebar"]',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var $this = $(this);
			var orientation;
			
			reader.onload = function (e) {
				var img = new Image();
				img.src = e.target.result;
				img.className = 'img-responsive';
				img.width = 200;
				
				$this.siblings('.imageContainer').html('').append(img);
				
				if ($this.siblings('.inputContainer').html() == '') {
				
					$this.siblings('.inputContainer')
						.append('<a class="remove">remove item</a>')
						.append('<div class="clear"></div>')
						.append('<input class="form-control haveToHeader" id="sidebar_title" name="sidebar_title" placeholder="Header">')
						.append('<textarea class="form-control froala" id="sidebar_text" name="sidebar_text" placeholder="Description"></textarea>')						
					;
				}
				
			};

			reader.readAsDataURL(this.files[0]);
			$this.fadeOut('fast');
		}
	})
	
	.on('click','.remove',function() {
		
		if (!confirm('Are you sure you want to remove this item?')) return false;
		
		if ($(this).data('ide')) deleted_articles.push($(this).data('ide'));
		//console.log(deleted_articles);
		
		var section = $(this).closest('.form-group').data('section');
		console.log(section);
		var num = $(this).closest('.imageContainer').data('length');
		var $uploadContainer = $(this).closest('.uploaderContainer');
		if (section == 'marry') { 
			if ($('.marryContainer').length == 30) {
				$uploadContainer.html('<div class="imageContainer marryContainer"></div><input type="file" name="marry[]">');
			}
		}
		else if (section == 'skirt') { 
			if ($('.skirtContainer').length == 30) {
				$uploadContainer.html('<div class="imageContainer skirtContainer"></div><input type="file" name="skirt[]">');
			}
		}
		else if (section == 'style') {
			if ($('.styleContainer').length == 4) {
				$uploadContainer.html('<div class="imageContainer styleContainer" data-length="'+num+'"></div><input type="file" class="styleUpload" name="style['+(num-1)+']">');
			}
		}
		else if (section == 'shopping') { 
			if ($('.styleContainer').length == 30) {
				$uploadContainer.html('<div class="imageContainer shoppingContainer"></div><input type="file" name="shopping[]">');
			}
		}
		else if (section == 'blogroll') { 
			$uploadContainer.html('<div class="imageContainer" id="blogrollContainer"></div><div class="inputContainer"></div><input type="file" name="blogroll">');
		}
		else if (section == 'haveto') { 
			$uploadContainer.replaceWith('<div class="uploaderContainer col-md-12"><div class="imageContainer" id="haveContainer"></div><div class="inputContainer"></div><input type="file" name="have_to"></div>');
		}
		else if (section == 'haveto-sidebar') { 
			$uploadContainer.html('<div class="imageContainer" id="haveContainer"></div><div class="inputContainer"></div><input type="file" name="sidebar">');
		}
		
		//$(this).closest('.uploaderContainer').remove();
	})
	
	.on('keyup','#left_bubble',function(){
		var val = $(this).val();
		$('.leftBubble span').text(val);
	})
	
	.on('keyup','#right_bubble',function(){
		var val = $(this).val();
		$('.rightBubble span').text(val);
	})
		
	.on('change keyup','#left_top',function(){
		if ($(this).val() && $(this).val() > 99) $(this).val(99);
		else if ($(this).val() && $(this).val() < 1) $(this).val(1);
		var number = $(this).val();
		$('.leftBubble').stop(true,false).animate({top: number+'%'},'slow');
	})
	
	.on('change keyup','#right_top',function(){
		if ($(this).val() && $(this).val() > 99) $(this).val(99);
		else if ($(this).val() < 1) $(this).val(1);
		var number = $(this).val();
		$('.rightBubble').stop(true,false).animate({top: number+'%'},'slow');
	})
	
	.on('change','#category',function() {
		var data = false;
		saved = false;
		$('input[type=text]').each(function(index, element) {
			if ($(this).val() && $(this).attr('name') != 'post_datetime') {
				data = true;
				return false;
			}
		});
		
		if (data) {
			if (!confirm("Changing the category will result in a loss of unsaved data.\n\rAre you sure you want to change this category?")) return false;
		}
		
		var val = $(this).val().toLowerCase().split(' ').join('-');
		$('#post-name').text($(this).val());
		if (val == 'have-to-have-it') {
			$('#left_top, #right_top').val(20);
			$('.body-name').html('Had To Have It Because:');
		}
		else $('.body-name').html('Post Body:');
		$('.remove').each(function(){
			$(this).trigger('click');
		});
		$('.toggled input, .toggled textarea').val('');
		$('.toggled .imageContainer').html('');
		
		$('.toggled').each(function(){
			if (!$(this).hasClass(val)) $(this).removeClass('toggled').fadeOut('fast');
		});
		$('.'+val).addClass('toggled').fadeIn('fast');
	})
	
	.on('click','.change-image',function() {
		var type = $(this).data('type');
		$(this).replaceWith('<br><input type="file" name="'+type+'" id="'+type+'">');
	})	
	
; // $('#body')