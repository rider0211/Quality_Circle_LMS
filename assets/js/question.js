/**
 * Created by kgc on 16. 5. 25.
 */

function init_quiz(quiz) {
    var id = quiz.attr("id");
	if(!id)
		id = quiz.data("id");
    var type = quiz.attr("type");
    $("form", quiz)
        .attr("method", "post")
        .param("id",id)
        .param("type",type);
    $("form input,form textarea,form select", quiz).change(function() {
        report_quiz(quiz);
    }).attr("autocomplete","off");
    if(type=="Matching") {
        $(".list-group-item input", quiz).change(function(e) {
            match_column(quiz);//$(e.target).parents("li[type]"));
        });
        $("canvas", quiz).click(function() {
            clear_match(quiz);
        });
        build_match(quiz);
    } else if(type=="FillInTheBlankEx") {
        $("input.blank").keypress(function(e) {
            var len = (this.value.length+1)*1.2;
			if(e.keyCode==27) 
				this.value = "";
			if(this.value=="")
				len = (this.placeholder.length+1)*1.2;
			if(len<4)
                len = 4;
            $(this).attr("size",len);
        });
    } else if(type=="WordBank") {
        $('label[draggable]',quiz)
            .jqxDragDrop({
                restricter: quiz,
                revert: true,
				dropTarget: $("div.blank",quiz)
            }).bind('dropTargetEnter', function (event) {
            	$(quiz).data("target",event.args.target);
                $(event.args.target).css('background-color', 'yellow');
                $(this).jqxDragDrop('dropAction', 'none');
            }).bind('dropTargetLeave', function (event) {
            	$(quiz).data("target",null);
                $(event.args.target).css('background-color', 'white');
                $(this).jqxDragDrop('dropAction', 'default');
            }).bind('dragEnd', function (event) {
            	target = $(quiz).data("target");
            	if(target) {
	            	target.text(event.args.text);
	                target.next("input").val(event.args.text);
	                report_quiz(quiz);
            	}
                $("div.blank",quiz).css('background-color', 'white');
            }).bind('dragStart', function (event) {
                $(this).jqxDragDrop('data', {
                	text: $(this).text()
                });
            });
    } else if(type=="Grouping") {
        $('label[draggable]',quiz).jqxDragDrop({
	            restricter: quiz,
	            revert: true,
	            dropTarget: $(".target",quiz)
	        }).bind('dropTargetEnter', function (event) {
	        	$(quiz).data("target",event.args.target);
	            $(event.args.target).css('color', 'red');
	            $(this).jqxDragDrop('dropAction', 'none');
	        }).bind('dropTargetLeave', function (event) {
	        	$(quiz).data("target",null);
	            $(event.args.target).css('color', 'black');
	            $(this).jqxDragDrop('dropAction', 'default');
	        }).bind('dragEnd', function (event) {
	        	target = $(quiz).data("target");
            	if(target) {
            		target.append("\n").append(event.args.node);
	                $("input",target).attr("name","solution[" + target.prevAll(".target").length + "][]");
	                event.args.feedback.remove();
	                //target.next("input").val(this.data.text());
	                report_quiz(quiz);
            	}
	            $(".target",quiz).css('color', 'black');
	        }).bind('dragStart', function (event) {
	            $(this).jqxDragDrop('data', {
	            	node: $(this)
	            });
	        });
    } else if(type=="Sequence") {
        $('ul', quiz).sortable({
            stop: function() {
                report_quiz(quiz);
            }
        });
    } else if(type=="Correct") {
        $("span.detail a", quiz).click(function() {
            var word = $(this).text();
            //var width = $(this).width()+parseInt($("ol#paper").css("font-size"))/8;
            if($("input",this).length)
                return;
            var input = $("<input style='padding:none;margin:none'>")
                .val(word)
                .css("line-height","1em")
                .width($(this).width())
                .change(function(e) {
                    $(e.target).parent("a").html(e.target.value).css("color","red");
                    $("textarea", quiz).val($("span.detail",quiz).html().trim());
                    report_quiz(quiz);
                }).blur(function(e) {
                    $(e.target).parent().html(e.target.value);
                }).keypress(function(e) {
                    $(e.target).attr("size",($(e.target).val().length+1)*1.2);
                });
            $(this).html("");
            input.appendTo(this).focus();
        });
        $("button", quiz).click(function() {
            $("span.detail", quiz).html($("span.hidden", quiz).html());
            $("textarea", quiz).val($("span.detail",quiz).text().trim());
            init_quiz(quiz);
        });
    } else if(type=="RecordVideo" || type=="RecordAudio") {
        $("button.record",quiz).click(function() {
            var recorder = $("object",quiz).get(0);
            if(recorder.record()) {
                $("button.record",quiz).addClass("hidden");
                $("button.finsish",quiz).removeClass("hidden");
            }
        });
        $("button.finish",quiz).click(function() {
            var recorder = $("object",quiz).get(0);
            recorder.finish();
            $("button.finsish",quiz).addClass("hidden");
            $("button.record",quiz).removeClass("hidden");
            $("input",quiz).val("true");
            report_quiz(quiz);
        });
    }
}

function report_quiz(quiz) {
    if($("iframe[name='_report']").length>0)
    	target = "_report";
    else
    	target = "";
    var type = quiz.attr("type");
    if($("form",quiz).attr("action")) {
	    $("form", quiz).ajaxSubmit({
	    	dataType:"json",
	    	target:target,
	    	success:function(res) {
	    		if(res.success) {
			        quiz.addClass("solved");
			        $(".navbar .solve-status").text($("ol#paper>li.problem").length + "문제중 " + $("ol#paper>li.problem.solved").length + "문제");
	    		}
	    	}
	    });
    }
}

function number(x,n) {
    var t = Math.pow(10,n);
    var val = Math.ceil(x * t) / t;
    return val;
}

function check_quiz(quiz) {
    $("form", quiz).ajaxSubmit();
    quiz.addClass("checked");
    var points = 0;
    var tags = $("input[type='number']", quiz);
    if(tags.length) {
        for(var i = 0;i<tags.length;i++) {
            var p = $(tags.get(i)).val();
            if(p!="")
                points += parseFloat(p);
        }
        points /= tags.length;
        $("span.marks",quiz).text(number(points,1));
    }
}

function match_column(quiz) {
    if(!quiz)
        return;
    if($(":radio:checked", quiz).length==2) {
        var n1 = $(":radio[name='column1']:checked", quiz).val();
        var n2 = $(":radio[name='column2']:checked", quiz).val();
        //$("span.match input:first-child[value='" + n1 + "']", quiz).parents("span.match").html("");
        //$("span.match input:last-child[value='" + n2 + "']", quiz).parents("span.match").html("");
        var num = $("span.match", quiz).length;
        var match = $("<span class='match'/>")
            .append("<input name='solution[" + num + "][column1]' value='" + n1 + "' type='hidden'>")
            .append("<input name='solution[" + num + "][column2]' value='" + n2 + "' type='hidden'>");
        match.appendTo($("form",quiz));
        build_match(quiz);

        $(":radio", quiz).each(function() {
            this.checked = false;
        });
        report_quiz(quiz);
    }
}

function clear_match(quiz) {
    var width = $("canvas", quiz).attr("width");
    var height = $("canvas", quiz).attr("height");
    var ctx = $("canvas", quiz).get(0).getContext("2d");
    ctx.clearRect(0,0,width,height);
    $("span.match", quiz).remove();
    quiz.removeClass("solved");
}

function build_match(quiz) {
    var width = $("canvas", quiz).parent().width();
    var height = $("div.row div.column1", quiz).height()-5;
	if(height<$("div.row div.column2", quiz).height()-5)
		height = $("div.row div.column2", quiz).height()-5;
    $("canvas", quiz).attr("width", width);
    $("canvas", quiz).attr("height", height);
    var ctx = $("canvas", quiz).get(0).getContext("2d");
    var pts1 = [], pts2 = [];
    $(".column1 .list-group-item", quiz).each(function() {
        var pos = $(this).position();
        pts1[$("input", this).val()] = {
            x: 0, y: pos.top + $(this).height()/2 + 11
        };
    });
    $(".column2 .list-group-item", quiz).each(function(i) {
        var pos = $(this).position();
        pts2[$("input", this).val()] = {
            x: width, y: pos.top + $(this).height()/2 + 11
        };
    });
    ctx.beginPath();
    ctx.strokeStyle = "darkgray";
    $("span.match:has(input):not(.correct):not(.incorrect)", quiz).each(function() {
        var i = $("input:first",this).val();
        var j = $("input:last",this).val();
        ctx.moveTo(pts1[i].x,pts1[i].y);
        ctx.bezierCurveTo((pts1[i].x+pts2[j].x)/2,pts1[i].y,(pts1[i].x+pts2[j].x)/2,pts2[j].y,pts2[j].x,pts2[j].y);
    });
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = "green";
    $("span.match.correct:has(input)", quiz).each(function() {
        var i = $("input:first",this).val();
        var j = $("input:last",this).val();
        ctx.moveTo(pts1[i].x,pts1[i].y);
        ctx.bezierCurveTo((pts1[i].x+pts2[j].x)/2,pts1[i].y,(pts1[i].x+pts2[j].x)/2,pts2[j].y,pts2[j].x,pts2[j].y);
    });
    ctx.stroke();
    ctx.beginPath();
    ctx.strokeStyle = "red";
    $("span.match.incorrect:has(input)", quiz).each(function() {
        var i = $("input:first",this).val();
        var j = $("input:last",this).val();
        ctx.moveTo(pts1[i].x,pts1[i].y);
        ctx.bezierCurveTo((pts1[i].x+pts2[j].x)/2,pts1[i].y,(pts1[i].x+pts2[j].x)/2,pts2[j].y,pts2[j].x,pts2[j].y);
    });
    ctx.stroke();
}

function audio_play(tag) {
    var audio = $(tag).next("audio").get(0);
    if(audio.paused) {
        if(audio.currentTime==0) {
            var id = $(tag).parents("li.problem").attr("id");
            $.post("/front/question/play",{id:id});
        }
        if($(".audio-player .button.pause").length)
            audio_play($(".audio-player .button.pause").get(0));
        audio.play();
    } else {
        clearInterval(audio.timer);
        audio.pause();
    }
    $(tag).toggleClass("pause");
}

function audio_progress(tag) {
    var audio = tag;
    $(tag).next(".progress").children().css("width",audio.currentTime*100/audio.duration+"%");
}

function audio_end(tag) {
    var audio = tag;
    $(tag).prev(".button").removeClass("pause");
    var count = $(tag).attr("count");
    if(count>1)
        $(tag).attr("count",count-1);
    else
        $(tag).parent().hide();
}

function video_play(url) {
    $("#video-player video source").attr("src","/www/uploads/"+url);
    var video = $("#video-player video").get(0);
    video.load();
    video.play();
}