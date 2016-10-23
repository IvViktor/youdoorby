<script>
	function getWishListCount(){
		jQuery.ajax({
			type: "POST",
			url: "<?php echo JURI::root() ?>components/com_vm_favorite/script/numberscript.php",
			data: ( {'cookie' : jQuery.cookie('vm_favorites')}),
			success: function(number){
				if(number > 0){
					let heartWrapper = document.getElementsByClassName('wishlist-container')[0];
					heartWrapper.innerHTML += number;
				}
			}
		});
	}	
</script>
