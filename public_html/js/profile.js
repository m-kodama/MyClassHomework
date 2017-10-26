'use strict';

const MAX_ACCELERATION = 90;

$(function() {

	const myIcon = $("#my-icon");
	const rotateStartBtn = $("#icon-rotate-start-btn");
	const rotateAddBtn = $("#icon-rotate-add-btn");
	const rotateStopBtn = $("#icon-rotate-stop-btn");

	let angle = 0;
	let acceleration = 1;
	let canRotate = false;

  	rotateStartBtn.on('click', function() {
  		canRotate = true;

  		rotateStartBtn.hide();
		rotateAddBtn.show();
		rotateStopBtn.show();
	});

	rotateAddBtn.on('click', function() {
		acceleration += 1;
		if(acceleration > MAX_ACCELERATION) acceleration = MAX_ACCELERATION;
	});

	rotateStopBtn.on('click', function() {
		canRotate = false;
		acceleration = 1;

		rotateStartBtn.show();
		rotateAddBtn.hide();
		rotateStopBtn.hide();
	});

	setInterval(function(){
		if(canRotate) {
			angle += acceleration;
		}
		myIcon.css("transform", "rotate("+angle+"deg)");
    },10);

	rotateAddBtn.hide();
	rotateStopBtn.hide();
});

