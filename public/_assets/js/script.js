/******/ (function (modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if (installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
            /******/
}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
            /******/
};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
        /******/
}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function (exports, name, getter) {
/******/ 		if (!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
    /******/
});
            /******/
}
        /******/
};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function (module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
        /******/
};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function (object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
    /******/
})
/************************************************************************/
/******/([
/* 0 */
/***/ (function (module, exports, __webpack_require__) {

        __webpack_require__(1);
        __webpack_require__(2);
        __webpack_require__(3);
        __webpack_require__(4);
        __webpack_require__(5);
        __webpack_require__(6);
        __webpack_require__(7);
        __webpack_require__(8);
        __webpack_require__(9);
        module.exports = __webpack_require__(10);


        /***/
}),
	/* 1 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            var token = $('meta[name="csrf-token"]').attr('content');

            // Reload
            // $('.header-icon.-back').click(function()
            // {
            // 	window.location=document.referrer;
            // 	//location.reload(true);
            //
            // 	return false;
            // });

            // Slide Out Menu
            var $toggleButton = $('.toggle-button'),
                $menuWrap = $('.menu-wrap'),
                $sidebarArrow = $('.sidebar-menu-arrow');

            // Hamburger button
            $toggleButton.on('click', function () {
                $(this).toggleClass('button-open');
                $menuWrap.toggleClass('menu-show');
            });

            //$('.chart').easyPieChart({
                // Your configuration goes here
            //});

            // Overlay
            $('.quick-nav').on('click', function () {
                $('.overlay').css('height', '100%');
                $('.overlay').addClass('-open');

                return false;
            });

            $('.close-overlay').on('click', function () {
                $('.overlay').css('height', '0');
                $('.overlay').removeClass('-open');

                return false;
            });

            // Set Page Lists Size (Prevents Footer Sitting Over Top)...
            var list_height = $('.page-list').height();
            $('.page-list').height(list_height + 40);

            // Formstone
            $(".custom-checkbox").checkbox();

            $('.info-popup').on('click', function () {
                var text = $(this).data('text');

                // Populate The Modal
                $('#info-modal .modal-body').html(text);
            });

            $('.nav-chevron').click(function () {
                var toggle = $(this).data('toggle');

                var ico = $('.chev');

                if (ico.hasClass('fa-chevron-up')) {
                    ico.removeClass('fa-chevron-up');
                    ico.addClass('fa-chevron-down');
                } else {
                    ico.removeClass('fa-chevron-down');
                    ico.addClass('fa-chevron-up');
                }

                $('.sub-nav' + '.' + toggle).fadeToggle();

                return false;
            });

            // Read Sections..
            $('.page-read').on('click', function () {
                var unit_id = $('.unit_id').val();
                var page_name = $('.page_name').val();

                if ($(this).is(':checked')) {
                    //$('.next-button').removeClass('no-show');
                    //$('.next-button').addClass('show-button');

                    // Post Via AJAX....
                    $.ajax({
                        type: 'POST',
                        url: '/page/extra/read',
                        data: { _token: token, unit_id: unit_id, page_name: page_name },
                        success: function success(data) {
                            // Do Nothing...
                        }
                    });
                } else {
                    $('.next-button').removeClass('show-button');
                    $('.next-button').addClass('no-show');
                }
            });
        });

        /***/
}),
	/* 2 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            // Multi Choice Questions Area....
            // See If Multi Choice Exists..
            var multi_choice = $('.multi-choice');

            if (multi_choice.length) {
                var call_ajax = function call_ajax() {
                    $.ajax({
                        type: "GET",
                        url: question_path,
                        cache: false,
                        dataType: "xml",
                        success: function success(xml) {
                            // // add xml
                            question_xml = xml;

                            // Hide Next Button...
                            $('.question-nav.forward-button').hide();

                            // Get Number Of Questions...
                            if (question_node >= 0) {
                                $(xml).find('question').each(function () {
                                    num_questions++;
                                });
                            }

                            get_next_question(0);
                        }
                    });
                };

                var get_next_question = function get_next_question(question_node) {
                    var question = $(question_xml).find('question').find('body').eq(question_node);

                    var question_title = question.find('question_title').text();
                    var option_a = question.find('question_answer_a').text();
                    var option_b = question.find('question_answer_b').text();
                    var option_c = question.find('question_answer_c').text();
                    var option_d = question.find('question_answer_d').text();
                    var explanation = question.find('question_explination').text();
                    var correct_answer = question.find('question_correct_answers').text();
                    var question_type = question.find('question_type').text();
                    var image_url = '/';
                    image_url += question.find('image_url').text();

                    console.log(question_title);
                    console.log(correct_answer);

                    if (question_type == 'image') {
                        $('.multi-choice').html('<h4 class="question">' + question_title + '</h4><div class="col-lg-12"><img class="center" src="' + image_url + '"/></div><h4 class="t-blue t-bold u-mt1 u-mb2 u-block">Mark one answer</h4><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a>');
                    }

                    if (question_type == 'multichoice') {
                        $('.multi-choice').html('<h4 class="question ">' + question_title + '</h4><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p> <a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a> <a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a> <a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a> <a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a>');
                    }

                    $('.info-popup').data('text', explanation);

                    // Set Page Title
                    $('.page__title').html('Question ' + (current_question + 1) + ' of ' + num_questions);

                    // Hide Next Button...
                    $('.question-nav.forward-button').hide();

                    if (question_node >= 1) {
                        // Show Back Button...
                        $('.question-nav.back-button').show();
                    } else {
                        // Hide Back Button...
                        $('.question-nav.back-button').hide();
                    }

                    // Check If Last Question (-1 because 0 started numbers)...

                    if (question_node == num_questions - 1) {
                        // Change The HTML Of The Button To Go To The Review Screen...
                        $('.question-nav.forward-button').html('<span>Confirm Answers <i class="fa fa-chevron-right"></i> </span>');
                        $('.question-nav.forward-button').addClass('confirm-answers');
                    } else {
                        $('.question-nav.forward-button').html('<span class="desktop">Next</span> <i class="fa fa-chevron-right"></i>');
                        $('.question-nav.forward-button').removeClass('confirm-answers');
                    }

                    option_click();
                };

                var option_click = function option_click(count) {
                    if (count) {
                        count = count;
                    } else {
                        count = 0;
                    }

                    $('.question-option').unbind('click');
                    $('.question-option').on('click', function () {
                        var chosen_answer = $(this).data('answer');

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');

                            // Remove The Chosen Answer...
                            $('.chosen-answers .question-' + current_question + '-' + chosen_answer + '').remove();

                            count--;
                        } else {
                            $(this).addClass('selected');

                            // Add The Chosen Answer...
                            $('.chosen-answers').append('<input class="chosen-answer-' + current_question + ' question-' + current_question + '-' + chosen_answer + '" type="hidden" name="chosen_answers[]" value="' + chosen_answer + '">');
                            count++;
                        }

                        // Prevent More Than One Answer Being Chosen....
                        if (count == '1') {
                            $('.question-nav.forward-button').show();
                        } else {
                            $('.question-nav.forward-button').hide();
                        }

                        return false;
                    });
                };

                var get_chosen_answer = function get_chosen_answer(current_question) {
                    var chosen_answer = $('.chosen-answer-' + current_question).val();

                    $('.option-' + chosen_answer).addClass('selected');

                    option_click(1);

                    $('.question-nav.forward-button').show();
                };

                // Set a Timer...
                $(function () {
                    var minutes = $('.minutes').val();
                    var timer2 = minutes + ':' + '00';
                    //var timer2 = "0:15";
                    var interval = setInterval(function () {
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = seconds < 0 ? --minutes : minutes;
                        seconds = seconds < 0 ? 59 : seconds;
                        seconds = seconds < 10 ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.countdown-timer').html(minutes + ':' + seconds);
                        if (minutes < 0) clearInterval(interval);
                        //check if both minutes and seconds are 0
                        if (seconds <= 0 && minutes <= 0) {
                            clearInterval(interval);
                            setInterval(function () {
                                $('.countdown-timer').fadeIn(300).fadeOut(500);
                            }, 500);
                        }
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                });

                // Multiple Choice Triggers Here...
                var question_path = $('.questions-path').val();

                var current_question = 0;
                var question_node = 0;
                var num_questions = 0;
                var question_xml;

                // Show a loader...
                $('.multi-choice').html('<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>');

                // Load Ajax XML
                call_ajax();

                $('.forward-button').on('click', function () {
                    if ($(this).hasClass('confirm-answers')) {
                        // Confirm Multiple Choice Answers...
                        $('.chosen-answers').submit();

                        return false;
                    } else {
                        current_question++;

                        // Get Questions Elements....
                        get_next_question(current_question);

                        return false;
                    }
                });

                $('.back-button').on('click', function () {
                    current_question--;

                    //remove the last element
                    $('.chosen-answers').children().last().remove()
                    // alert('back')



                    // Get Questions Elements....
                    get_next_question(current_question);

                    // Get The Chosen Answer
                    // get_chosen_answer(current_question);

                    return false;
                });
            }

            // Reviewing Answers...
            var reviewing_answers = $('.answer_append');

            if (reviewing_answers.length) {
                var question_id = $('.question_id').val();
                var score_id = $('.score_id').val();
                var answer_id = $('.answer_id').val();
                var unit_id = $('.unit_id').val();

                $('.append-answer').click(function () {
                    var chosen_answer = $(this).data('answer');
                    var item = $(this);

                    if (item.hasClass('locked')) {
                        return false;
                    } else {
                        $('.append-answer').each(function () {
                            if ($(this).hasClass('selected')) {
                                $(this).removeClass('selected');
                            }

                            if ($(this).hasClass('incorrect')) {
                                $(this).removeClass('incorrect');
                            }

                            if ($(this).hasClass('correct')) {
                                $(this).removeClass('correct');
                            }
                        });

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $(this).addClass('selected');
                        }

                        // Send AJAX Call..
                        $.ajax({
                            type: 'POST',
                            url: '/multi-choice/append-answer',
                            dataType: 'json',
                            data: {
                                _token: token,
                                answer: chosen_answer,
                                answer_id: answer_id,
                                question_id: question_id,
                                score_id: score_id,
                                unit_id: unit_id
                            },
                            success: function success(data) {
                                var answer = data.answer;

                                item.addClass(answer);

                                if (answer == 'correct') {
                                    $('.append-answer').each(function () {
                                        $(this).addClass('locked');
                                    });
                                }
                            }
                        });
                    }
                    return false;
                });
            }
        });

        /***/
}),
	/* 3 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            var token = $('meta[name="csrf-token"]').attr('content');

            var section = $('.section_name').val();
            var section_id = $('.section_id').val();

            $(".video").bind("ended", function () {

                var video_id = $(this).data('id');
                var user_id = $('.user_id').val();
                var video_title = $(this).data('title');

                // Post Via AJAX..
                $.ajax({
                    type: 'POST',
                    url: '/video/mark-watched',
                    data: {
                        _token: token,
                        video_clip_id: video_id,
                        video_title: video_title,
                        video_section: section,
                        section_id: section_id
                    },
                    success: function success(data) {
                        $('.watched-' + video_id).show();
                    }
                });
            });

            $('a.download-link').click(function () {
                var download_title = $(this).data('title');
                var link_url = $(this).attr('href');

                $.ajax({
                    type: 'POST',
                    url: '/download/mark-downloaded',
                    data: { _token: token, download_title: download_title, section: section, section_id: section_id },
                    success: function success(data) {
                        $('.downloaded-' + section_id).show();
                        var win = window.open(link_url, '_blank');
                        win.focus();
                    }
                });

                return false;
            });

            $('.breadcrumb').on('click', function () {
                if ($('.section-read').is(':checked')) {
                    return true;
                } else {
                    toastr.error('Please mark this section as read before progressing');
                }

                return false;
            });

            // Getting Started Pages
            var section_name = $('.section_name').val();
            var page_name = $('.page_name').val();
            var page_id = $('.page_id').val();

            // Read Sections..
            $('.section-read').on('click', function () {
                if ($(this).is(':checked')) {
                    $('.next-button').removeClass('no-show');
                    $('.next-button').addClass('show-button');

                    // Post Via AJAX....
                    $.ajax({
                        type: 'POST',
                        url: '/page/mark-read',
                        data: { _token: token, section_name: section_name, section_id: section_id, page_id: page_id },
                        success: function success(data) {
                            // Do Nothing...
                        }
                    });
                } else {
                    $('.next-button').removeClass('show-button');
                    $('.next-button').addClass('no-show');
                }
            });

            // Reviewing Answers
            var review_answers = $('.gs_append');

            if (review_answers.length) {
                var question_id = $('.question_id').val();
                var score_id = $('.score_id').val();
                var answer_id = $('.answer_id').val();
                var unit_id = $('.unit_id').val();

                $('.append-answer').click(function () {
                    var chosen_answer = $(this).data('answer');
                    var item = $(this);

                    if (item.hasClass('locked')) {
                        return false;
                    } else {
                        $('.append-answer').each(function () {
                            if ($(this).hasClass('selected')) {
                                $(this).removeClass('selected');
                            }

                            if ($(this).hasClass('incorrect')) {
                                $(this).removeClass('incorrect');
                            }

                            if ($(this).hasClass('correct')) {
                                $(this).removeClass('correct');
                            }
                        });

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $(this).addClass('selected');
                        }

                        // Send AJAX Call..
                        $.ajax({
                            type: 'POST',
                            url: '/getting-started/append-answer',
                            dataType: 'json',
                            data: {
                                _token: token,
                                answer: chosen_answer,
                                answer_id: answer_id,
                                question_id: question_id,
                                score_id: score_id,
                                unit_id: unit_id
                            },
                            success: function success(data) {
                                var answer = data.answer;

                                item.addClass(answer);

                                if (answer == 'correct') {
                                    $('.append-answer').each(function () {
                                        $(this).addClass('locked');
                                    });
                                }
                            }
                        });
                    }
                    return false;
                });
            }
        });

        /***/
}),
	/* 4 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            // See If Multi Choice Exists..
            var road_signs = $('.road-signs');

            if (road_signs.length) {
                var call_ajax = function call_ajax() {
                    $.ajax({
                        type: "GET",
                        url: question_path,
                        cache: false,
                        dataType: "xml",
                        success: function success(xml) {
                            // // add xml
                            question_xml = xml;

                            // Hide Next Button...
                            $('.question-nav.forward-button').hide();

                            // Get Number Of Questions...
                            if (question_node >= 0) {
                                $(xml).find('question').each(function () {
                                    num_questions++;
                                });
                            }

                            get_next_question(0);
                        }
                    });
                };

                // Text Area(s) - Add Class On Click


                var get_next_question = function get_next_question(question_node) {
                    var question = $(question_xml).find('question').find('body').eq(question_node);

                    var question_title = question.find('question_title').text();
                    var option_a = question.find('question_answer_a').text();
                    var option_b = question.find('question_answer_b').text();
                    var option_c = question.find('question_answer_c').text();
                    var option_d = question.find('question_answer_d').text();
                    var explanation = question.find('question_explination').text();
                    var correct_answer = question.find('question_correct_answers').text();
                    var question_type = question.find('question_type').text();
                    var image_url = '/';
                    image_url += question.find('image_url').text();

                    console.log(question_title);
                    console.log(correct_answer);

                    // Reset HTML Area..
                    $('.road-signs').html('');

                    if (question_type == 'images') {
                        $('.road-signs').html('<h4 class="question t-bold u-mb2 u-block">' + question_title + '</h4><a href="#" class="question-option -image option-a" data-answer="a"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_a + ' alt=""/></span> </a> <a href="#" class="question-option -image option-b" data-answer="b"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_b + ' alt=""/></span> </a> <a href="#" class="question-option -image option-c" data-answer="c"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_c + ' alt=""/></span> </a> <a href="#" class="question-option -image option-d" data-answer="d"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_d + ' alt=""/></span> </a>');
                    }

                    if (question_type == 'image') {
                        $('.road-signs').html('<div class="row"><div class="col-lg-12"><h4 class="question t-bold">' + question_title + '</h4></div></div><div class="row"><div class="col-lg-12"><img class="img-responsive center roadsign-image" src="' + image_url + '"/></div></div><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a>');
                    }

                    $('.info-popup').data('text', explanation);

                    $('.road-signs').append('<div class="form-group u-mt1"><label class="control-label">Write a brief description of where you might find this sign. What are the risks/potential risks and what action you would take?</label><textarea name="reference" class="form-control form__input form__textarea reference__box" placeholder="Your Answer" data-error="Please enter an answer" required></textarea><div class="help-block with-errors"></div></div>');

                    // Set Page Title
                    $('.page__title').html('Question ' + (current_question + 1) + ' of ' + num_questions);

                    // Hide Next Button...
                    $('.question-nav.forward-button').hide();

                    if (question_node >= 1) {
                        // Show Back Button...
                        $('.question-nav.back-button').show();
                    } else {
                        // Hide Back Button...
                        $('.question-nav.back-button').hide();
                    }

                    // Check If Last Question (-1 because 0 started numbers)...

                    if (question_node == num_questions - 1) {
                        // Change The HTML Of The Button To Go To The Review Screen...
                        $('.question-nav.forward-button').html('<span>Confirm Answers <i class="fa fa-chevron-right"></i> </span>');
                        $('.question-nav.forward-button').addClass('confirm-answers');
                    } else {
                        $('.question-nav.forward-button').html('<span class="desktop">Next</span> <i class="fa fa-chevron-right"></i>');
                        $('.question-nav.forward-button').removeClass('confirm-answers');
                    }

                    option_click();

                    // Call Keyup
                    call_keyup();
                };

                var call_keyup = function call_keyup() {
                    text_entered = false;

                    var text_box = $('.reference__box');

                    // Reset
                    text_box.val('');

                    $(text_box).on('keyup', function () {
                        if ($(text_box).val() != '') {
                            text_entered = true;

                            if (option_selected == true && text_entered == true) {
                                // Add Description Text...
                                var question_exists = $('.question-' + current_question + '').length;

                                if (question_exists == 0) {
                                    $('.chosen-answers').append('<input class="chosen-answer-text' + current_question + ' question-' + current_question + '" type="hidden" name="answer_explanation[]" value="">');
                                }

                                $('.question-' + current_question + '').val(text_box.val());

                                $('.question-nav.forward-button').show();
                            }
                        } else {
                            text_entered = false;
                        }
                    });
                };

                var option_click = function option_click(count) {
                    if (count) {
                        count = count;
                    } else {
                        count = 0;
                    }

                    $('.question-option').unbind('click');
                    $('.question-option').on('click', function () {
                        var chosen_answer = $(this).data('answer');

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');

                            // Remove The Chosen Answer...
                            $('.chosen-answers .question-' + current_question + '-' + chosen_answer + '').remove();

                            count--;
                        } else {
                            $(this).addClass('selected');

                            // Add The Chosen Answer...
                            $('.chosen-answers').append('<input class="chosen-answer-' + current_question + ' question-' + current_question + '-' + chosen_answer + '" type="hidden" name="chosen_answers[]" value="' + chosen_answer + '">');
                            count++;
                        }

                        // Prevent More Than One Answer Being Chosen....
                        if (count == '1') {
                            option_selected = true;

                            if (option_selected == true && text_entered == true) {
                                $('.question-nav.forward-button').show();
                            }
                        } else {
                            option_selected = false;

                            $('.question-nav.forward-button').hide();
                        }

                        return false;
                    });
                };

                var get_chosen_answer = function get_chosen_answer(current_question) {
                    var chosen_answer = $('.chosen-answer-' + current_question).val();

                    $('.option-' + chosen_answer).addClass('selected');

                    option_click(1);

                    $('.question-nav.forward-button').show();
                };

                var question_path = $('.questions-path').val();

                var current_question = 0;
                var question_node = 0;
                var num_questions = 0;
                var question_xml;
                var text_entered = false;
                var option_selected = false;

                // Show a loader...
                $('.road-signs').html('<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>');

                // Load The AJAX File...
                call_ajax();

                $(document).on("focus", "textarea", function () {
                    $(this).addClass('-open');
                });

                $('.forward-button').on('click', function () {
                    if ($(this).hasClass('confirm-answers')) {
                        // Confirm Multiple Choice Answers...
                        $('.chosen-answers').submit();

                        return false;
                    } else {
                        current_question++;

                        // Get Questions Elements....
                        get_next_question(current_question);

                        return false;
                    }
                });

                $('.back-button').on('click', function () {
                    current_question--;

                    //remove the last element
                    $('.chosen-answers').children().last().remove()
                    // alert('back')


                    // Get Questions Elements....
                    get_next_question(current_question);

                    // Get The Chosen Answer
                    // get_chosen_answer(current_question);

                    return false;
                });
            }

            // Reviewing Answers
            var review_answers = $('.review_append');

            if (review_answers.length) {
                var question_id = $('.question_id').val();
                var score_id = $('.score_id').val();
                var answer_id = $('.answer_id').val();
                var unit_id = $('.unit_id').val();

                $('.append-answer').click(function () {
                    var chosen_answer = $(this).data('answer');
                    var item = $(this);

                    if (item.hasClass('locked')) {
                        return false;
                    } else {
                        $('.append-answer').each(function () {
                            if ($(this).hasClass('selected')) {
                                $(this).removeClass('selected');
                            }

                            if ($(this).hasClass('incorrect')) {
                                $(this).removeClass('incorrect');
                            }

                            if ($(this).hasClass('correct')) {
                                $(this).removeClass('correct');
                            }
                        });

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $(this).addClass('selected');
                        }

                        // Send AJAX Call..
                        $.ajax({
                            type: 'POST',
                            url: '/road-signs-quiz/append-answer',
                            dataType: 'json',
                            data: {
                                _token: token,
                                answer: chosen_answer,
                                answer_id: answer_id,
                                question_id: question_id,
                                score_id: score_id,
                                unit_id: unit_id
                            },
                            success: function success(data) {
                                var answer = data.answer;

                                item.addClass(answer);

                                if (answer == 'correct') {
                                    $('.append-answer').each(function () {
                                        $(this).addClass('locked');
                                    });
                                }
                            }
                        });
                    }
                    return false;
                });

                var delay = function () {
                    var timer = 0;
                    return function (callback, ms) {
                        clearTimeout(timer);
                        timer = setTimeout(callback, ms);
                    };
                }();

                $('.reference__box').keyup(function () {
                    delay(function () {
                        var answer_text = $('.reference__box').val();

                        // User's Finished Typing, Now Save New Explanation to DB...
                        $.ajax({
                            type: 'POST',
                            url: '/road-signs-quiz/append-explanation',
                            dataType: 'json',
                            data: {
                                _token: token,
                                answer_id: answer_id,
                                question_id: question_id,
                                score_id: score_id,
                                unit_id: unit_id,
                                answer_text: answer_text
                            },
                            success: function success(data) {
                                toastr.success(data.message);
                            }
                        });
                    }, 1000);
                });
            }
        });

        /***/
}),
	/* 5 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            var foundation = $('.foundation-area');
            var token = $('meta[name="csrf-token"]').attr('content');

            // Set Token Headers (CSRF Protection)...
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (foundation.length) {
                var call_ajax = function call_ajax() {
                    $.ajax({
                        type: "GET",
                        url: question_path,
                        cache: false,
                        dataType: "xml",
                        success: function success(xml) {
                            // // add xml
                            question_xml = xml;

                            // Hide Next Button...
                            $('.question-nav.forward-button').hide();

                            // Get Number Of Questions...
                            if (question_node >= 0) {
                                $(xml).find('question').each(function () {
                                    num_questions++;

                                    // Populate The Quick Nav....
                                    $('.overlay-content').append('<a class="quick-nav__link" href="#" data-value="' + question_x++ + '">Question ' + num_questions + '</a>');
                                });
                            }

                            $('.foundation-nav-area').fadeIn();

                            quick_nav_click();

                            get_next_question(0);
                        }
                    });
                };

                // Text Area(s) - Add Class On Click


                var quick_nav_click = function quick_nav_click() {
                    $('.quick-nav__link').on('click', function () {
                        var question_number = $(this).data('value');

                        if (question_number !== '') {
                            current_question = parseInt(question_number);

                            get_next_question(question_number);
                        }

                        var overlay = $('.overlay');

                        if (overlay.hasClass('-open')) {
                            $('.overlay').css('height', '0%');
                        }

                        return false;
                    });
                };

                var get_next_question = function get_next_question(question_node) {
                    var question = $(question_xml).find('question').find('body').eq(question_node);

                    var question_title = question.find('question_title').text();

                    var question_links = question.find('links');
                    var question_children = question_links.children();

                    // Set Page Title
                    $('.page__title').html('Question ' + (current_question + 1) + ' of ' + num_questions);

                    $(foundation).html('<h4 class="question">' + question_title + '</h4><form class="foundation-form foundation-' + question_node + '" data-toggle="validator"><div class="form-group"> <label class="control-label">My Answer</label><textarea name="answer" class="form-control form__input form__textarea answer" minlength="180" placeholder="My Answer" data-minlength="180" data-error="In order to move on, please give a more comprehensive explanation" required></textarea><span class="glyphicon form-control-feedback" aria-hidden="true"></span><div class="help-block with-errors"></div></div><div class="form-group"> <label class="control-label">Reference</label><textarea name="reference" class="form-control form__input form__textarea" min="10" placeholder="Reference" data-error="Please enter a reference" required></textarea><span class="glyphicon form-control-feedback" aria-hidden="true"></span><div class="help-block with-errors"></div></div><div class="row u-mt2"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <button type="submit" class="foundation-save button -purple u-pt1 u-pb1" data-question="' + question_node + '">Save</button></div></div></form>');

                    if (question_children.length > 0) {
                        $(foundation).append('<div class="row u-mt2"><div class="col-lg-12"><h3 class="u-mb1">Useful References:</h3><p>The links below offer useful additional reference for some of the questions. Compare the information in the link with that in your own answers. DriverActive links must be followed to complete the course fully</p></div></div><div class="row u-mt2"><div class="col-lg-12"><ul class="links-list"></ul></div></div>');

                        $.each(question_children, function (index, value) {
                            var link_title = $(value).find('link_title').text();
                            var link_url = $(value).find('link_url').text();
                            var link_note = $(value).find('link_note').text();

                            if (link_note.length > 0) {
                                $('.links-list').append('<li><a target="_blank" href="' + link_url + '">' + link_title + '</a><span class="u-block u-pt1 u-pb1">' + link_note + '</span></li>');
                            } else {
                                $('.links-list').append('<li><a target="_blank" href="' + link_url + '">' + link_title + '</a></li>');
                            }
                        });
                    }

                    // Clear Anawer Area...
                    $('.foundation-answer-area').html('');

                    // Toggle The Validator On The Form...
                    $('.foundation-form').validator();

                    // Load The Click For The Form Submission
                    foundation_save();

                    // Load Any Answers...
                    load_answers(question_node);

                    if (question_node >= 1) {
                        // Show Back Button...
                        $('.question-nav.back-button').show();
                    } else {
                        // Hide Back Button...
                        $('.question-nav.back-button').hide();
                    }

                    if (question_node == num_questions - 1) {
                        // Forward Button (Back To Unit Home)...
                        var unit_id = $('.unit_id').val();

                        $('.question-nav.forward-button').addClass('to-home');
                        $('.question-nav.forward-button').html('Back To Unit Home');
                        $('.question-nav.forward-button').attr('href', '/theory/study/' + unit_id);
                    } else {
                        // Show Forward Button...
                        $('.question-nav.forward-button').show();
                        $('.question-nav.forward-button').html('<span class="desktop">Next</span> <i class="fa fa-chevron-right"></i>');
                        $('.question-nav.forward-button').removeClass('to-home');
                    }
                };

                var load_answers = function load_answers(question_node) {
                    $.ajax({
                        type: 'GET',
                        url: '/theory/get-user-answers/' + question_node + '/' + unit_name + '?nolog=true',
                        success: function success(data) {
                            if (data != '[]') {
                                var obj = jQuery.parseJSON(data);
                                $.each(obj, function (key, value) {
                                    $('.foundation-answer-area').append('<div class="foundation-answer"> <h4 class="u-block u-mb1">Saved on ' + value.friendly_date + ' (' + value.friendly_time + ') </h4> <div class="u-mt2 u-mb2"> <p class="t-f16 t-bold">Reference</p> <p>' + value.foundation_reference + '</p></div><div class="u-mt2 u-mb2"> <p class="t-f16 t-bold">My Answer</p> <p>' + value.foundation_answer + '</p></div></div>');
                                });

                                $('.answer').attr({ 'min': 0, 'minlength': 0 });
                                $('.answer').data('minlength', 0);
                            } else {
                                $('.foundation-answer-area').html('<div class="foundation-answer no-answers"> <div class="u-mt2 u-mb2"> <h4>No Answers Saved</h4></div>');

                                $('.answer').attr({ 'min': 180, 'minlength': 180 });
                                $('.answer').data('minlength', 180);
                            }
                        }
                    });
                };

                var foundation_save = function foundation_save() {
                    $('.foundation-save').on('click', function () {
                        var question = $(this).data('question');

                        if ($(this).hasClass('disabled')) {
                            // Do Nothing...
                        } else {
                            var form = $('.foundation-' + question);

                            var section = $('.section').val();

                            if (section) {
                                form.append('<input type="hidden" name="section" value="' + section + '">');
                            }

                            form.append('<input type="hidden" name="question_number" value="' + question + '">');
                            form.append('<input type="hidden" name="unit_name" value="' + unit_name + '">');
                            form.append('<input type="hidden" name="unit_id" value="' + unit_id + '">');

                            var form_data = $(form).serialize();

                            // Now Send AJAX Post...
                            $.ajax({
                                method: "POST",
                                url: "/theory/save-answer",
                                data: form_data,
                                dataType: 'json',
                                success: function success(data) {
                                    // Now Reset Form Fields....
                                    $('.foundation-' + question + ' *').filter(':input').each(function () {
                                        $(this).val('');
                                    });

                                    toastr.success(data.message);

                                    $('.no-answers').hide();

                                    $('.foundation-answer-area').prepend('<div class="foundation-answer"> <div class="u-mt2 u-mb2"> <h4>Reference</h4> <p>' + data.reference + '</p></div><div class="u-mt2 u-mb2"> <h4>My Answer</h4> <p>' + data.answer + '</p></div></div>');
                                }
                            });
                        }

                        return false;
                    });
                };

                // Load Foundation Data...
                var question_path = $('.questions-path').val();

                var current_question = 0;
                var question_node = 0;
                var num_questions = 0;
                var question_xml = '';
                var unit_name = $('.unit_name').val();
                var unit_id = $('.unit_id').val();
                var question_x = 0;
                var num_answers = 0;

                // Hide Info Button...
                $('.info-area').hide();

                // Show a loader...
                $(foundation).html('<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>');

                // Load Ajax XML
                call_ajax();

                $(document).on("focus", "textarea", function () {
                    $(this).addClass('-open');
                });

                $('.foundation-jump').change(function () {
                    var question_number = $(this).val();

                    if (question_number !== '') {
                        current_question = parseInt(question_number);

                        get_next_question(question_number);
                    }
                });

                $('.forward-button').on('click', function () {
                    if ($(this).hasClass('confirm-answers')) {
                        // Confirm Multiple Choice Answers...
                        $('.chosen-answers').submit();

                        return false;
                    } else {
                        if ($(this).hasClass('to-home')) {
                            return true;
                        } else {
                            current_question++;

                            // Get Questions Elements....
                            get_next_question(current_question);

                            return false;
                        }
                    }
                });

                $('.back-button').on('click', function () {
                    current_question--;

                    //remove the last element
                    $('.chosen-answers').children().last().remove()
                    // alert('back')


                    // Get Questions Elements....
                    get_next_question(current_question);

                    return false;
                });
            } // End IF...
        });

        /***/
}),
	/* 6 */
	/***/ (function (module, exports) {

        $(document).ready(function () {

            var hazard_area = $('.hazard-area');

            if (hazard_area.length) {
                var endTheHazardGame = function endTheHazardGame(sc1, sc2, message, video, stop) {
                    // Stop Clicking & Clear Flags...
                    //$('.hazard-click').unbind('click');
                    $('#append_chances').html('');

                    $('.hazard-scoring').show();
                    $('.hazard-response').show();

                    clearInterval(count_hazardCountdown);

                    $('#footer').fadeIn();

                    if (stop == true) {
                        // Stop The Video....
                        $('.hazard-error').show();
                        $('.hazard-score').html(0);

                        video.pause();
                    } else {
                        var finalScore = sc1 + sc2;

                        $('.hazard-score').html(finalScore);

                        var hazard_score_name = $('.video_title').val();
                        var hazard_video_id = $('.video_id').val();
                        var video_section = $('.video_section').val();
                        var hazard_category_id = $('.video_category').val();

                        var clicks = [];

                        $('.clicks').each(function () {
                            clicks.push($(this).val());
                        });

                        // Save Score...
                        $.ajax({
                            type: 'POST',
                            url: '/hazard/save-score',
                            data: {
                                _token: token,
                                hazard_score: finalScore,
                                hazard_score_name: hazard_score_name,
                                hazard_video_id: hazard_video_id,
                                hazard_video_section: video_section,
                                hazard_category_id: hazard_category_id,
                                clicks: clicks
                            },
                            success: function success(data) {
                                // Save Score...
                                $('.score-review').attr("href", "/theory/hazard/review/" + data.score_id);
                            }
                        });
                    }
                };

                var token = $('meta[name="csrf-token"]').attr('content');
                var hazardcountdowntimer;
                var totalHazardTime = 0;
                var clickTotals = 0;
                var myScore = 0;
                var mySecondScore = 0;
                var have_scored = false;
                var have_scored_again = false;
                var thisVideoLength = 99999;
                var numberOfClicks = [];
                var alertTime = 0;
                var video = document.getElementById("hazzard_video_player");
                var diff;

                // See If We Are In Hazard Area...
                var hazard_area = $('.hazard-area');

                if (hazard_area.length) {
                    var record_clicks = function record_clicks() {
                        // Record Clicks....
                        //var thisStart = parseFloat($('.video-start').val());
                        var thisStart = $('.video-start').val();
                        var scoringEnd = parseFloat($('.video-end').val());
                        var scoringSeconds = parseFloat(scoringEnd) - parseFloat(thisStart);
                        var thisSecondStart = -5;
                        var thisSecondEnd = -5;
                        var thisEnd = parseFloat(thisStart) + scoringSeconds;
                        var thisVideo = '';
                        var thisRecap = '';
                        // var thisNumber = $(this).attr('data-number');
                        // hazzardVideoNumber = thisNumber;

                        if (thisStart.length != 1) {

                            var times = thisStart.split(",");
                            thisStart = parseFloat(times[0]);
                            thisSecondStart = parseFloat(times[1]);
                            thisSecondEnd = parseFloat(thisSecondStart) + 5;
                        } else {
                            thisStart = parseFloat($('.video-start').val());
                        }

                        $('#append_chances').append('<span class="t-red chance-block"><i class="fa fa-flag"></i></span>');

                        clickTotals++;

                        if (clickTotals > thisVideoLength) {
                            clickTotals = 0;
                        }

                        if (numberOfClicks.length < 5) {
                            numberOfClicks.push(new Date().getTime());
                        } else {
                            diff = numberOfClicks[numberOfClicks.length - 1] - numberOfClicks[0] - alertTime;
                            console.log(diff);

                            if (diff < 5000) {
                                var beforeAlert = new Date().getTime();
                                clearInterval(hazardcountdowntimer);

                                // Clicking Too Much (End)...
                                endTheHazardGame(0, 0, 'You have clicked in an unacceptable fashion!', video, true);

                                clickTotals = 0;

                                var afterAlert = new Date().getTime();
                                alertTime = afterAlert - beforeAlert;
                            }

                            numberOfClicks.shift();
                            numberOfClicks.push(new Date().getTime());
                        }

                        if (totalHazardTime >= thisStart && totalHazardTime <= thisEnd) {
                            var tht = parseFloat(totalHazardTime);
                            var ts = parseFloat(thisStart);

                            if (totalHazardTime == ts) {
                                myScore = 5;
                            }

                            if (totalHazardTime == ts + 1) {
                                var tempScore = 4;

                                if (myScore < tempScore) {
                                    myScore = 4;
                                }
                            }
                            if (totalHazardTime == ts + 2) {
                                var tempScore = 3;

                                if (myScore < tempScore) {
                                    myScore = 3;
                                }
                            }
                            if (totalHazardTime == ts + 3) {
                                var tempScore = 2;
                                if (myScore < tempScore) {
                                    myScore = 2;
                                }
                            }
                            if (totalHazardTime == ts + 4) {
                                var tempScore = 1;
                                if (myScore < tempScore) {
                                    myScore = 1;
                                }
                            }

                            have_scored = true;
                        } else {
                            if (!have_scored) {
                                myScore = 0;
                            }
                        }

                        if (totalHazardTime >= thisSecondStart && totalHazardTime <= thisSecondEnd) {
                            var tht = parseFloat(totalHazardTime);
                            var ts = parseFloat(thisSecondStart);

                            if (totalHazardTime == ts) {
                                mySecondScore = 5;
                            }

                            if (totalHazardTime == ts + 1) {
                                var tempScore = 4;

                                if (mySecondScore < tempScore) {
                                    mySecondScore = 4;
                                }
                            }
                            if (totalHazardTime == ts + 2) {
                                var tempScore = 3;

                                if (mySecondScore < tempScore) {
                                    mySecondScore = 3;
                                }
                            }

                            if (totalHazardTime == ts + 3) {
                                var tempScore = 2;

                                if (mySecondScore < tempScore) {
                                    mySecondScore = 2;
                                }
                            }

                            if (totalHazardTime == ts + 4) {
                                var tempScore = 1;

                                if (mySecondScore < tempScore) {
                                    mySecondScore = 1;
                                }
                            }

                            have_scored_again = true;
                        } else {
                            if (!have_scored_again) {
                                mySecondScore = 0;
                            }
                        }

                        var i = 1;
                        i++;

                        // Save The Click...
                        var vid = document.getElementById("hazzard_video_player");
                        currentTime = parseFloat(vid.currentTime);
                        $('.scoring-log').append('<input type="hidden" class="clicks" name="clicks[]" value="' + currentTime + '">');
                    };

                    $('.hazard-click').on('click', function () {
                        if ($(this).hasClass('play')) {
                            $(this).removeClass('play');

                            // Clear Clicks...
                            $('.scoring-log').html('');

                            // Play Video...
                            video.play();

                            $('#footer').fadeOut();

                            $('.hazard-response').hide();
                            $('.hazard-error').hide();

                            $('#append_clock_holder').hide();

                            $('#append_chances').html('');
                        } else {
                            record_clicks();
                        }

                        return false;
                    });

                    $('.restart-video').on('click', function () {
                        // Clear Clicks...
                        $('.scoring-log').html('');

                        video.pause();
                        video.currentTime = 0;
                        video.load();
                        video.play();

                        $('#footer').fadeOut();

                        diff = 0;
                        numberOfClicks = [];

                        record_clicks();

                        var play_icon = $('.hazard-click');

                        if (play_icon.hasClass('play')) {
                            play_icon.removeClass('play');
                        }

                        $('.hazard-response').hide();
                        $('.hazard-error').hide();

                        $('#append_clock_holder').hide();

                        $('#append_chances').html('');

                        return false;
                    });

                    // Bind End / Start Functions...
                    $(".hazard-video").bind('playing', function () {
                        // Video Started
                        $('#append_chances').html('');

                        $('#footer').fadeOut();

                        var TotalSeconds = 0;
                        hazardcountdowntimer = setInterval(function () {
                            timer();
                        }, 1000); // 100 will run it every 0.1 second
                        count_hazardCountdown = hazardcountdowntimer;

                        function timer() {
                            var vid = document.getElementById("hazzard_video_player");
                            totalHazardTime = parseInt(vid.currentTime) + 1;

                            console.log(totalHazardTime);
                        }
                    });

                    $(".hazard-video").bind("ended", function () {
                        // Video Finished...
                        $('.hazard-click').addClass('play');

                        $('#footer').fadeIn();

                        clearInterval(count_hazardCountdown);
                        clickTotals = 0;

                        if (myScore != 0) {
                            endTheHazardGame(myScore, mySecondScore, 'Well Done!', video);
                        } else {
                            endTheHazardGame(myScore, mySecondScore, '', video);
                        }
                    });
                }

                var vid = document.getElementById("hazzard_video_player");
                var scoring_start = $('.scoring_start').val();
                var scoring_end = $('.scoring_end').val();
                var video_length = '';

                vid.ontimeupdate = function () {
                    //var video_length = $('.video_length').val();
                    video_length = Math.round(vid.duration);

                    //console.log(vid.currentTime);

                    //console.log(scoring_start+ '|' + video_length + '|' + vid.currentTime);

                    var percentage = Math.round(vid.currentTime) / video_length * 100;
                    //var fixed = percentage.toFixed(2);
                    //var percentage_total = fixed;

                    $("#custom-seekbar span").css("width", percentage + "%");
                };

                vid.onplay = function () {
                    //video_length = Math.round(vid.duration);
                    video_length = vid.duration;

                    if (scoring_start.length != 1) {
                        var times = scoring_start.split(",");
                        var end_time = scoring_end.split(",");

                        setTimeout(function () {
                            $('#custom-seekbar').fadeIn();
                            $('.hazard-review-area').fadeIn();

                            $.each(times, function (k, v) {
                                var percentage = times[k] / video_length * 100;
                                var score_diff = end_time[k] - times[k];
                                var scoring_width = score_diff / video_length * 100;

                                $('.scoring-zone.-zone-' + k).css('left', percentage + "%");
                                $('.scoring-zone.-zone-' + k).css('width', scoring_width + "%");
                            });
                        }, 1);
                    } else {
                        setTimeout(function () {
                            $('#custom-seekbar').fadeIn();
                            $('.hazard-review-area').fadeIn();

                            var percentage = scoring_start / video_length * 100;
                            var score_diff = scoring_end - scoring_start;
                            var scoring_width = score_diff / video_length * 100;

                            $('.scoring-zone').css('left', percentage + "%");
                            $('.scoring-zone').css('width', scoring_width + "%");
                        }, 1);
                    }
                };
            }

            // Reviewing Answers
            var review_answers = $('.hazard_append');

            if (review_answers.length) {
                var question_id = $('.question_id').val();
                var score_id = $('.score_id').val();
                var answer_id = $('.answer_id').val();

                $('.append-answer').click(function () {
                    var chosen_answer = $(this).data('answer');
                    var item = $(this);

                    if (item.hasClass('locked')) {
                        return false;
                    } else {
                        $('.append-answer').each(function () {
                            if ($(this).hasClass('selected')) {
                                $(this).removeClass('selected');
                            }

                            if ($(this).hasClass('incorrect')) {
                                $(this).removeClass('incorrect');
                            }

                            if ($(this).hasClass('correct')) {
                                $(this).removeClass('correct');
                            }
                        });

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                        } else {
                            $(this).addClass('selected');
                        }

                        // Send AJAX Call..
                        $.ajax({
                            type: 'POST',
                            url: '/theory/hazard/append-answer',
                            dataType: 'json',
                            data: {
                                _token: token,
                                answer: chosen_answer,
                                answer_id: answer_id,
                                question_id: question_id,
                                score_id: score_id
                            },
                            success: function success(data) {
                                var answer = data.answer;

                                item.addClass(answer);

                                if (answer == 'correct') {
                                    $('.append-answer').each(function () {
                                        $(this).addClass('locked');
                                    });
                                }
                            }
                        });
                    }
                    return false;
                });
            }
        });

        /***/
}),
	/* 7 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            var token = $('meta[name="csrf-token"]').attr('content');
            var mock_start = $('.mock-start');

            if (mock_start.length) {
                var call_ajax = function call_ajax() {
                    var test_type = $('.test_type').val();
                    var flagged = $('.flagged').val();

                    // Get The Questions...

                    if (test_type == 'incorrect') {
                        question_url = '/mock-questions/incorrect?nolog=true';
                    } else {
                        if (flagged) {
                            question_url = '/mock-questions/' + get_questions + '/' + category_id + '/' + flagged + '?nolog=true';
                        } else {
                            question_url = '/mock-questions/' + get_questions + '/' + category_id + '?nolog=true';
                        }
                    }

                    $.ajax({
                        type: 'GET',
                        url: question_url,
                        dataType: 'json',
                        success: function success(data) {
                            question_data = data;

                            // Hide Next Button...
                            $('.question-nav.forward-button').hide();

                            // Get Number Of Questions...
                            if (question_node >= 0) {
                                $(question_data['questions']).each(function () {
                                    num_questions++;
                                });
                            }

                            get_next_question(0);
                        }
                    });
                };

                var get_next_question = function get_next_question(question_node) {
                    var question = question_data['questions'][question_node];

                    var question_title = question.question_title;
                    var option_a = question.question_answer_a;
                    var option_b = question.question_answer_b;
                    var option_c = question.question_answer_c;
                    var option_d = question.question_answer_d;
                    var explanation = question.question_explination;
                    var brand = question.question_brand;
                    var question_type = question.question_type;
                    var question_meta = question.question_meta;
                    var image_url = '/media/multichoice';

                    question_id = question.mock_question_id;

                    var correct_answer = question.question_correct_answers;

                    console.log(question_title);
                    console.log(correct_answer);

                    if (question_type == 'images') {
                        if (question_meta !== '') {
                            question_image = image_url + '/' + question_meta;

                            $(mock_start).html('<h4 class="question u-block u-mb1">' + question_title + '</h4><div class="u-block u-mb1"><img class="img-responsive center" src="' + question_image + '" /></div><a href="#" class="question-option -image option-a" data-answer="a"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_a + ' alt=""/></span> </a> <a href="#" class="question-option -image option-b" data-answer="b"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_b + ' alt=""/></span> </a> <a href="#" class="question-option -image option-c" data-answer="c"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_c + ' alt=""/></span> </a> <a href="#" class="question-option -image option-d" data-answer="d"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_d + ' alt=""/></span> </a>');
                        } else {
                            $(mock_start).html('<h4 class="question">' + question_title + '</h4><a href="#" class="question-option -image option-a" data-answer="a"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_a + ' alt=""/></span> </a> <a href="#" class="question-option -image option-b" data-answer="b"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_b + ' alt=""/></span> </a> <a href="#" class="question-option -image option-c" data-answer="c"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_c + ' alt=""/></span> </a> <a href="#" class="question-option -image option-d" data-answer="d"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_d + ' alt=""/></span> </a>');
                        }
                    }

                    if (question_type == 'image') {
                        question_image = image_url + '/' + question_meta;

                        $(mock_start).html('<h4 class="question">' + question_title + '</h4><div class="row"><div class="col-md-5 col-md-offset-3 u-block u-mb1"><img class="img-responsive center" src="' + question_image + '"/></div></div><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a>');
                    }

                    if (question_type == 'multichoice') {
                        $(mock_start).html('<h4 class="question">' + question_title + '</h4><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a><span class="u-block u-mt2 brand -' + brand + '"></span>');
                    }

                    // Update The Flag ID...
                    $('.flag-question').data('flag-id', question_id);

                    $('.info-popup').data('text', explanation);

                    // Set Page Title
                    $('.page__title').html('Question ' + (current_question + 1) + ' of ' + num_questions);

                    // Hide Next Button...
                    $('.question-nav.forward-button').hide();

                    if (question_node >= 1) {
                        // Show Back Button...
                        $('.question-nav.back-button').show();
                    } else {
                        // Hide Back Button...
                        $('.question-nav.back-button').hide();
                    }

                    // Check If Last Question (-1 because 0 started numbers)...

                    if (question_node == num_questions - 1) {
                        // Change The HTML Of The Button To Go To The Review Screen...
                        $('.question-nav.forward-button').html('<span>Confirm Answers <i class="fa fa-chevron-right"></i> </span>');
                        $('.question-nav.forward-button').addClass('confirm-answers');
                    } else {
                        $('.question-nav.forward-button').html('<span class="desktop">Next</span> <i class="fa fa-chevron-right"></i>');
                        $('.question-nav.forward-button').removeClass('confirm-answers');
                    }

                    option_click();
                };

                var option_click = function option_click(count) {
                    if (count) {
                        count = count;
                    } else {
                        count = 0;
                    }

                    $('.question-option').unbind('click');
                    $('.question-option').on('click', function () {
                        var chosen_answer = $(this).data('answer');

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');

                            // Remove The Chosen Answer...
                            $('.chosen-answers .question-' + current_question + '-' + chosen_answer + '').remove();

                            count--;
                        } else {
                            $(this).addClass('selected');

                            // Add The Chosen Answer...
                            $('.chosen-answers').append('<input class="chosen-answer-' + current_question + ' question-' + current_question + '-' + chosen_answer + '" type="hidden" name="chosen_answers[][' + question_id + ']" value="' + chosen_answer + '">');
                            count++;
                        }

                        // Prevent More Than One Answer Being Chosen....
                        if (count == '1') {
                            $('.question-nav.forward-button').show();
                        } else {
                            $('.question-nav.forward-button').hide();
                        }

                        return false;
                    });
                };

                var get_chosen_answer = function get_chosen_answer(current_question) {
                    var chosen_answer = $('.chosen-answer-' + current_question).val();

                    $('.option-' + chosen_answer).addClass('selected');

                    option_click(1);

                    $('.question-nav.forward-button').show();
                };

                // Set a Timer...
                $(function () {
                    var minutes = $('.minutes').val();
                    var timer2 = minutes + ':' + '00';
                    //var timer2 = "0:15";
                    var interval = setInterval(function () {
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = seconds < 0 ? --minutes : minutes;
                        seconds = seconds < 0 ? 59 : seconds;
                        seconds = seconds < 10 ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.countdown-timer').html(minutes + ':' + seconds);
                        if (minutes < 0) clearInterval(interval);
                        //check if both minutes and seconds are 0
                        if (seconds <= 0 && minutes <= 0) {
                            clearInterval(interval);
                            setInterval(function () {
                                $('.countdown-timer').fadeIn(300).fadeOut(500);
                            }, 500);
                        }
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                });

                var current_question = 0;
                var question_node = 0;
                var num_questions = 0;
                var question_id;
                var question_data;
                var get_questions = $('.num_questions').val();
                var category_id = $('.category').val();

                // Show a loader...
                $(mock_start).html('<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>');

                // Load AJAX jSON
                call_ajax();

                $('.forward-button').on('click', function () {
                    if ($(this).hasClass('confirm-answers')) {
                        // Confirm Multiple Choice Answers...
                        $('.chosen-answers').submit();

                        return false;
                    } else {
                        current_question++;

                        // Get Questions Elements....
                        get_next_question(current_question);

                        return false;
                    }
                });

                $('.back-button').on('click', function () {
                    current_question--;

                    //remove the last element
                    $('.chosen-answers').children().last().remove()


                    // Get Questions Elements....
                    get_next_question(current_question);

                    // Get The Chosen Answer
                    // get_chosen_answer(current_question);

                    return false;
                });

                $('.flag-question').click(function () {
                    var question_id = $(this).data('flag-id');

                    $('.chosen-answers').append('<input class="chosen-answer-' + question_id + ' question-' + question_id + '" type="hidden" name="chosen_answers[][' + question_id + ']" value="">');

                    $.ajax({
                        type: 'POST',
                        url: '/theory/flag-question',
                        data: {
                            _token: token,
                            question_id: question_id
                        },
                        success: function success(data) {
                            toastr.success('Question Flagged');

                            // Move Forward....
                            $('.forward-button').trigger('click');
                        }
                    });

                    return false;
                });
            }
        });

        /***/
}),
	/* 8 */
	/***/ (function (module, exports) {

        $(document).ready(function () {
            var token = $('meta[name="csrf-token"]').attr('content');
            var learner_start = $('.learner-start');

            if (learner_start.length > 0) {
                var call_ajax = function call_ajax() {
                    var test_type = $('.test_type').val();
                    var flagged = $('.flagged').val();

                    // Get The Questions...

                    if (test_type == 'incorrect') {
                        question_url = '/mock-questions/incorrect?nolog=true';
                    } else {
                        if (flagged) {
                            question_url = '/learner-questions/' + get_questions + '/' + category_id + '/' + flagged + '?nolog=true';
                        } else {
                            question_url = '/learner-questions/' + get_questions + '/' + category_id + '?nolog=true';
                        }
                    }

                    $.ajax({
                        type: 'GET',
                        url: question_url,
                        dataType: 'json',
                        success: function success(data) {
                            question_data = data;

                            // Hide Next Button...
                            $('.question-nav.forward-button').hide();

                            // Get Number Of Questions...
                            if (question_node >= 0) {
                                $(question_data['questions']).each(function () {
                                    num_questions++;
                                });
                            }

                            get_next_question(0);
                        }
                    });
                };

                var get_next_question = function get_next_question(question_node) {
                    var question = question_data['questions'][question_node];

                    var question_title = question.question_title;
                    var option_a = question.question_answer_a;
                    var option_b = question.question_answer_b;
                    var option_c = question.question_answer_c;
                    var option_d = question.question_answer_d;
                    var explanation = question.question_explination;
                    var brand = question.question_brand;
                    var question_type = question.question_type;
                    var question_meta = question.question_meta;
                    var image_url = '/media/learners';

                    question_id = question.learner_question_id;

                    var correct_answer = question.question_correct_answers;

                    console.log(question_title);
                    console.log(correct_answer);

                    if (question_type == 'images') {
                        if (question_meta !== '') {
                            question_image = image_url + '/' + question_meta;

                            $(learner_start).html('<h4 class="question u-block u-mb1">' + question_title + '</h4><div class="u-block u-mb1"><img class="img-responsive center" src="' + question_image + '" /></div><a href="#" class="question-option -image option-a" data-answer="a"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_a + ' alt=""/></span> </a> <a href="#" class="question-option -image option-b" data-answer="b"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_b + ' alt=""/></span> </a> <a href="#" class="question-option -image option-c" data-answer="c"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_c + ' alt=""/></span> </a> <a href="#" class="question-option -image option-d" data-answer="d"> <span class="question-option__image"><img class="img-responsive center" src=' + image_url + '/' + option_d + ' alt=""/></span> </a>');
                        } else {
                            $(learner_start).html('<h4 class="question">' + question_title + '</h4><a href="#" class="question-option -image option-a" data-answer="a"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_a + ' alt=""/></span> </a> <a href="#" class="question-option -image option-b" data-answer="b"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_b + ' alt=""/></span> </a> <a href="#" class="question-option -image option-c" data-answer="c"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_c + ' alt=""/></span> </a> <a href="#" class="question-option -image option-d" data-answer="d"> <span class="question-option__image"><img class="img-responsive" src=' + image_url + '/' + option_d + ' alt=""/></span> </a>');
                        }
                    }

                    if (question_type == 'image') {
                        question_image = image_url + '/' + question_meta;

                        $(learner_start).html('<h4 class="question">' + question_title + '</h4><div class="row"><div class="col-md-5 col-md-offset-3 u-block u-mb1"><img class="img-responsive center" src="' + question_image + '"/></div></div><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a>');
                    }

                    if (question_type == 'multichoice') {
                        $(learner_start).html('<h4 class="question">' + question_title + '</h4><p class="t-f16 u-mt1 u-mb1 u-block">Mark 1 answer</p><a href="#" class="question-option option-a" data-answer="a"> <span class="question-option__text">' + option_a + '</span> </a><a href="#" class="question-option option-b" data-answer="b"> <span class="question-option__text">' + option_b + '</span> </a><a href="#" class="question-option option-c" data-answer="c"> <span class="question-option__text">' + option_c + '</span> </a><a href="#" class="question-option option-d" data-answer="d"> <span class="question-option__text">' + option_d + '</span> </a><span class="u-block u-mt2 brand -' + brand + '"></span>');
                    }

                    // Update The Flag ID...
                    $('.flag-question').data('flag-id', question_id);

                    $('.info-popup').data('text', explanation);

                    // Set Page Title
                    $('.page__title').html('Question ' + (current_question + 1) + ' of ' + num_questions);

                    // Hide Next Button...
                    $('.question-nav.forward-button').hide();

                    if (question_node >= 1) {
                        // Show Back Button...
                        $('.question-nav.back-button').show();
                    } else {
                        // Hide Back Button...
                        $('.question-nav.back-button').hide();
                    }

                    // Check If Last Question (-1 because 0 started numbers)...

                    if (question_node == num_questions - 1) {
                        // Change The HTML Of The Button To Go To The Review Screen...
                        $('.question-nav.forward-button').html('<span>Confirm Answers <i class="fa fa-chevron-right"></i> </span>');
                        $('.question-nav.forward-button').addClass('confirm-answers');
                    } else {
                        $('.question-nav.forward-button').html('<span class="desktop">Next</span> <i class="fa fa-chevron-right"></i>');
                        $('.question-nav.forward-button').removeClass('confirm-answers');
                    }

                    option_click();
                };

                var option_click = function option_click(count) {
                    if (count) {
                        count = count;
                    } else {
                        count = 0;
                    }

                    $('.question-option').unbind('click');
                    $('.question-option').on('click', function () {
                        var chosen_answer = $(this).data('answer');

                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');

                            // Remove The Chosen Answer...
                            $('.chosen-answers .question-' + current_question + '-' + chosen_answer + '').remove();

                            count--;
                        } else {
                            $(this).addClass('selected');

                            // Add The Chosen Answer...
                            $('.chosen-answers').append('<input class="chosen-answer-' + current_question + ' question-' + current_question + '-' + chosen_answer + '" type="hidden" name="chosen_answers[][' + question_id + ']" value="' + chosen_answer + '">');
                            count++;
                        }

                        // Prevent More Than One Answer Being Chosen....
                        if (count == '1') {
                            $('.question-nav.forward-button').show();
                        } else {
                            $('.question-nav.forward-button').hide();
                        }

                        return false;
                    });
                };

                var get_chosen_answer = function get_chosen_answer(current_question) {
                    var chosen_answer = $('.chosen-answer-' + current_question).val();

                    $('.option-' + chosen_answer).addClass('selected');

                    option_click(1);

                    $('.question-nav.forward-button').show();
                };

                // Set a Timer...
                $(function () {
                    var minutes = $('.minutes').val();
                    var timer2 = minutes + ':' + '00';
                    //var timer2 = "0:15";
                    var interval = setInterval(function () {
                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = seconds < 0 ? --minutes : minutes;
                        seconds = seconds < 0 ? 59 : seconds;
                        seconds = seconds < 10 ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.countdown-timer').html(minutes + ':' + seconds);
                        if (minutes < 0) clearInterval(interval);
                        //check if both minutes and seconds are 0
                        if (seconds <= 0 && minutes <= 0) {
                            clearInterval(interval);
                            setInterval(function () {
                                $('.countdown-timer').fadeIn(300).fadeOut(500);
                            }, 500);
                        }
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                });

                var current_question = 0;
                var question_node = 0;
                var num_questions = 0;
                var question_id;
                var question_data;
                var get_questions = $('.num_questions').val();
                var category_id = $('.category').val();

                // Show a loader...
                $(learner_start).html('<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>');

                // Load AJAX jSON
                call_ajax();

                $('.forward-button').on('click', function () {
                    if ($(this).hasClass('confirm-answers')) {
                        // Confirm Multiple Choice Answers...
                        $('.chosen-answers').submit();

                        return false;
                    } else {
                        current_question++;

                        // Get Questions Elements....
                        get_next_question(current_question);

                        return false;
                    }
                });

                $('.back-button').on('click', function () {
                    current_question--;

                    //remove the last element
                    $('.chosen-answers').children().last().remove()
                    // alert('back')


                    // Get Questions Elements....
                    get_next_question(current_question);

                    // Get The Chosen Answer
                    // get_chosen_answer(current_question);

                    return false;
                });

                $('.flag-question').click(function () {
                    var question_id = $(this).data('flag-id');

                    $('.chosen-answers').append('<input class="chosen-answer-' + question_id + ' question-' + question_id + '" type="hidden" name="chosen_answers[][' + question_id + ']" value="">');

                    $.ajax({
                        type: 'POST',
                        url: '/theory/flag-question',
                        data: {
                            _token: token,
                            question_id: question_id
                        },
                        success: function success(data) {
                            toastr.success('Question Flagged');

                            // Move Forward....
                            $('.forward-button').trigger('click');
                        }
                    });

                    return false;
                });
            }
        });

        /***/
}),
	/* 9 */
	/***/ (function (module, exports) {

        $(document).ready(function () {

            var reflections = $('.reflections-area');
            var token = $('meta[name="csrf-token"]').attr('content');

            // Set Token Headers (CSRF Protection)...
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (reflections.length) {
                // Text Area(s) - Add Class On Click
                $(document).on("focus", "textarea", function () {
                    $(this).addClass('-open');
                });

                // Save
                $('.reflection-save').on('click', function () {
                    var question = $(this).data('question');

                    if ($(this).hasClass('disabled')) {
                        // Do Nothing...
                    } else {
                        var form = $('.reflections-form');

                        var form_data = $(form).serialize();

                        // Now Send AJAX Post...
                        $.ajax({
                            method: "POST",
                            url: "/theory/save-reflections",
                            data: form_data,
                            dataType: 'json',
                            success: function success(data) {
                                toastr.success(data.message);

                                // Now Reload Page....
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                        });
                    }

                    return false;
                });
            }
        });

        /***/
}),
	/* 10 */
	/***/ (function (module, exports) {

        // removed by extract-text-webpack-plugin

        /***/
})
	/******/]);