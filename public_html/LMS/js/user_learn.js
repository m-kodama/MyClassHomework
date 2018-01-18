"use strict";

$(function() {

	// ラジオボタンが押されたら回答ボタンのdisabledを解除する
	$('input[type=radio]').on(TOUCH, function() {
		$('.answer-btn').removeClass('disabled');
	});	
	
});

