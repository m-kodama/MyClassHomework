"use strict";

$(function() {

	// コンテンツを追加ボタンのタッチイベント
	$('.add-content-btn').on(TOUCH, function() {

		const course = $(this).data("course");

		const input = $('input[name="course"]');
		input.val(course);
		
		const form = $('form[name="manage_content"]');
		form.submit();
	});

	// 編集ボタンのタッチイベント
	$('.edit-content-btn').on(TOUCH, function() {

		const course = $(this).data("course");
		const question = $(this).data("question");
		const correct_answer = $(this).data("correct-answer");
		const answer1 = $(this).data("answer1");
		const answer2 = $(this).data("answer2");
		const answer3 = $(this).data("answer3");
		const question_id = $(this).data("content-id");

		const input_course = $('input[name="course"]');
		const input_question = $('input[name="question"]');
		const input_correct_answer = $('input[name="correct_answer"]');
		const input_answer1 = $('input[name="answer1"]');
		const input_answer2 = $('input[name="answer2"]');
		const input_answer3 = $('input[name="answer3"]');
		const input_question_id = $('input[name="question_id"]');

		input_course.val(course);
		input_question.val(question);
		input_correct_answer.val(correct_answer);
		input_answer1.val(answer1);
		input_answer2.val(answer2);
		input_answer3.val(answer3);
		input_question_id.val(question_id);
		
		const form = $('form[name="manage_content"]');
		form.submit();
	});

});

