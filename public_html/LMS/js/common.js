"use strict";
const TOUCH = 'ontouchstart' in window ? 'touchend' : 'click';

$(function() {
  // headerの初期化
  $(".button-collapse").sideNav();
  
});
