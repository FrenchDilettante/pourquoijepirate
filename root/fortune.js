function rollthedice() {
	$.ajax({
		type: "get",
		url: "ajax/random.php",
		data: {},
		success: function(data) {
			$(".fortune").remove();
			$(".main").append(data);
		}
	});
}

function deselect(id) {
	$(".fortune[data-id="+id+"] .select").html("<em>En cours...</em>");
	$.ajax({
		type: "get",
		url: "ajax/select.php",
		data: {
			action: "rem",
			id: id
		},
		success: function(data) {
			if (location.href.indexOf("selection.php") > 0) {
				$(".fortune[data-id="+id+"]").slideUp();
			} else {
				setTimeout(function() {
					$.get("ajax/fortune.php?id=" + id, function(data) {
						$(".fortune[data-id="+id+"]").replaceWith(data);
					});
				}, 500);
			}
			$("#select_menu").html(data);
		}
	});
}

function select(id) {
	$(".fortune[data-id="+id+"] .select").html("<em>En cours...</em>");
	$.ajax({
		type: "get",
		url: "ajax/select.php",
		data: {
			action: "add",
			id: id
		},
		success: function(data) {
			$(".fortune[data-id="+id+"] .select").html("&#9733;Sélectionné !");
			$("#select_menu").html(data);
		}
	});
}

function signaler(id) {
	$(".fortune[data-id="+id+"] .signaler").html("<em>En cours...</em>");
	$.ajax({
		type: 'post',
		url: 'ajax/signaler.php',
		data: {
			id: id
		},
		success: function(data) {
			if (data == "OK") {
				$(".fortune[data-id="+id+"] .signaler").html("Merci !");
			} else {
				$(".fortune[data-id="+id+"] .signaler").html("Vous l'avez déjà signalé, merci tout de même !");
			}
		}
	});
	
	return false;
}

function voter(id, vote) {
	$(".fortune[data-id="+id+"] .votes").html("<em>En cours...</em>");
	$.ajax({
		type: 'post',
		url: 'ajax/voter.php',
		data: {
			id: id,
			vote: vote
		},
		success: function(data) {
			$(".fortune[data-id="+id+"] .votes").html(data);
		}
	});
	
	return false;
}

