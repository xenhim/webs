$(document).ready(function(){
		$(".genre-item").click(function() {
			var e = $(this).find("span");
			e.hasClass("icon-checkbox") ? e.removeClass("icon-checkbox").addClass("icon-tick") : e.hasClass("icon-tick") ? e.removeClass("icon-tick").addClass("icon-cross") : e.removeClass("icon-cross").addClass("icon-checkbox")
		})
		$(".btn-search").click(function() {
			var e = $(".btn-reset").attr("href"),
				t = "",
				a = "",
				n = "",
				i = "";
			$.each($(".genre-item span"), function(e, o) {
				$(o).hasClass("icon-tick") ? (t += n + $(o).attr("data-id"), n = ",") : $(o).hasClass("icon-cross") && (a += i + $(o).attr("data-id"), i = ",")
			})
			location.href = e + "?category=" + t + "&notcategory=" + a + "&country=" + $("#country").val() + "&status=" + $("#status").val() + "&minchapter=" + $("#minchapter").val() + "&sort=" + $("#sort").val()
		})

		$(".btn-collapse").click(function() {
		
			$(this).find(".show-text").toggleClass("hidden"), $(this).find(".hide-text").toggleClass("hidden"), $(this).find(".fa").toggleClass("fa-angle-double-down").toggleClass("fa-angle-double-up"), $(".advsearch-form").toggleClass("hidden")
		})
});	