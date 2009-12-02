$(document).ready( function() {
	
	/**
	 * GUI Tabs Toggle
	 */
	$('li[gui_tab]').click(function(){
		// Get tab properties
		var key = $(this).attr('gui_key');
		// Panel
		var panel = $('input[gui_tabs_panel='+key+']').val();
		// Turn off all panels
		$('input[gui_tabs_panel]').each(function(){
			$('#'+$(this).val()).hide();
		});
		// Turn on current panel
		$('#'+panel).fadeIn('slow');
	});
	
	/**
	 * Provides functionality for 
	 * Up / Down / Top  / Bottom Links 
	 */
	$('a[gui_move]').click(function(){
		
		var move = $(this).attr('gui_move');
		var listbox = $(this).attr('gui_listbox');

		$('#'+listbox+' option:selected').each(function(){
			switch(move)
			{
				case 'up':
					$(this).insertBefore($(this).prev());
				break;
			
				case 'down':
					$(this).insertAfter($(this).next());
				break;
			
				case 'top':
					if($(this).attr('index') > $('#'+listbox+' option:first').attr('index'))//this check is to prevent trying to move item that is already at the top
					{
						$(this).insertBefore($('#'+listbox+' option:first'));
					}
				break;
			
				case 'bottom':
					if($(this).attr('index') < $('#'+listbox+' option:last').attr('index'))//this check is to prevent trying to move item that is already at the bottom
					{
						$(this).insertAfter($('#'+listbox+' option:last'));
					}
				break;
			}
		});
		return false;
	});
	
	/**
	 * Provides select functionality
	 */
	$('select[gui_list_selector]').dblclick(function(){
		$('select[gui_list_selector] option:selected').each(function(){
			$('select[gui_list_selected]').append($(this));
		});
	});
	
});